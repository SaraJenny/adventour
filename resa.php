<?php
/*
* Sara Petersson - Webbanvändbarhet, DT068G
* 
*/
// Kollar om resmålets id är satt
if (isset($_GET["id"])) {
	// Aktiverar autoload för att snabba upp registrering av klasser
	spl_autoload_register(function ($classObject) {
	    include 'includes/class/' . $classObject . '.class.php';
	});
	// Skapar objekt
	$travel = new Travel();
	// Hämtar information om resmål
	$destination = $travel->getTravel($_GET["id"]);
	// Om resmålet inte existerar i databasen skickas besökaren till reseväljarsidan
	if ($destination == false) {
		header("Location: resor.php");
    	exit;
	}
	foreach ($destination as $key) {
		// Skapar variabler
		$id = $key['travel_id'];
		$name = $key['name'];
		$days = $key['days'];
		$price = $key['price'];
		$date = $key['dep_date'];
		$month = $key['month'];
		$image = $key['image'];
		$description = html_entity_decode($key['description']);
		$itinerary = html_entity_decode($key['itinerary']);
		$lat = $key['lat'];
		$lon = $key['lon'];
	}
	// Hämtar bilder
	$photo = $travel->getPhotos($id);
	// Hämtar kundomdömen
	$report = $travel->getReports($id);

	// Skapar tomma variabler
	$first_lastname = $street = $address = $email = $phone = $bookingMessage = '';
	$destinationErr = $first_lastnameErr = $streetErr = $addressErr = $emailErr = $phoneErr = '';

	/*--------------------- För användare som inaktiverat javascript ---------------------*/
	// Om användaren tryckt på boka-knapp valideras formulär (avaktiverat javascript)
	if (isset($_POST["submitBooking"])) {
	    // Kollar om resmål är tomt
	    if (empty($_POST['dest'])) {
	        // Felmeddelande
	        $destinationErr = "Resmål krävs";
	    }
	    else {
	    	$dest = $_POST['dest'];
	    }
	    // Kollar om namn är tomt
	    if (empty($_POST['first_lastname'])) {
	        // Felmeddelande
	        $first_lastnameErr = "För- och efternamn krävs";
	    }
	    else {
	    	$first_lastname = $_POST['first_lastname'];
	    }
	    // Kollar om gatuadress är tomt
	    if (empty($_POST['street'])) {
	        // Felmeddelande
	        $streetErr = "Gatuadress krävs";
	    }
	    else {
	    	$street = $_POST['street'];
	    }
	    // Kollar om postadress är tomt
	    if (empty($_POST['address'])) {
	        // Felmeddelande
	        $addressErr = "Postadress krävs";
	    }
	    else {
	    	$address = $_POST['address'];
	    }
	    // Kollar om e-post fyllts i
	    if (empty($_POST['email'])) {
	        // Felmeddelande
	        $emailErr = "E-post krävs";
	    }
	    else {
	        // Skapar variabel
	        $email = $_POST['email'];
	        // Kollar om e-mailaddressen inte är välformulerad
	        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	            // Felmeddelande
	            $emailErr = "Ogiltigt epost-format";
	        }
	    }
	    // Kollar om telefonnummer fyllts i
	    if (empty($_POST['phone'])) {
	        // Felmeddelande
	        $phoneErr = "Telefonnummer krävs";
	    }
	    else {
	    	$phone = $_POST['phone'];
	    }
	    // Om inga felmeddelanden är satta skickas bokningsförfrågan via mejl
	    if ($destinationErr == '' && $first_lastnameErr == '' && $streetErr == '' && $addressErr == '' && $emailErr == '' && $phoneErr == '') {
	    	$message = $travel->bookTravel($name, $first_lastname, $street, $address, $email, $phone);
	    	if ($message == true) {
	    		$bookingMessage = "<p class='message success'>Din bokningsförfrågan är skickad och vi återkommer inom 24 timmar.</p>";
	    	}
	    	else {
	    		$bookingMessage = "<p class='message fail'>Tyvärr kunde inte din bokningsförfrågan skickas. Vänligen försök igen eller kontakta oss på 01-234 56 78</p>";
	    	}
	    }
	}
	/*------------------------------------------------------------------------------------*/
	// Undersidans titel
	$page_title = $name;
	// Hämtar in headern
	include("includes/header.php");
?>
	<script>
		// Sparar resmålets koordinater till Google maps
		var lat = <?php echo $lat; ?>;
		var lon = <?php echo $lon; ?>;
	</script>
	<main>
		<section id="mainContent">
			<h2><?php echo $name; ?></h2>
			<section class="mainContainer">
				<img src="<?php __DIR__; ?>/images/travels/<?php echo $image; ?>.jpg" alt="<?php echo $name; ?>">
				<?php
/*--------------------- För användare som inaktiverat javascript ---------------------*/
				?>
				<section id="js-travel">
				<?php
				if (isset($_GET["text"]) && $_GET["text"] == "desc") {
				?>
					<!-- Navigation för reseinfo -->
					<ul id="travelNav">
						<li id="descLink" class="chosen"><a href='resa.php?id=<?php echo $id; ?>&text=desc'>Beskrivning</a></li
						><li>
							<a id="planLink" href='resa.php?id=<?php echo $id; ?>&text=plan'>Reseupplägg</a>
						</li
						><li>
							<a id="priceLink" href='resa.php?id=<?php echo $id; ?>&text=price'>Pris</a>
						</li
						><li>
							<a id="photoLink" href='resa.php?id=<?php echo $id; ?>&text=photo'>Foton</a>
						</li>
				    </ul><!-- /#travelNav -->
				    <article>
				    	<p class="heading">Nästa avresa: <?php echo $date; ?></p>
				    	<?php echo $description; ?>
				    </article>
				<?php
				}
				else if (isset($_GET["text"]) && $_GET["text"] == "plan") {
				?>
					<!-- Navigation för reseinfo -->
					<ul id="travelNav">
						<li id="descLink"><a href='resa.php?id=<?php echo $id; ?>&text=desc'>Beskrivning</a></li
						><li>
							<a id="planLink" class="chosen" href='resa.php?id=<?php echo $id; ?>&text=plan'>Reseupplägg</a>
						</li
						><li>
							<a id="priceLink" href='resa.php?id=<?php echo $id; ?>&text=price'>Pris</a>
						</li
						><li>
							<a id="photoLink" href='resa.php?id=<?php echo $id; ?>&text=photo'>Foton</a>
						</li>
				    </ul><!-- /#travelNav -->
				    <article>
				    	<p class="heading">Avresedag: <?php echo $date; ?></p>
				    	<?php echo $itinerary; ?>
				    </article>
				<?php
				}
				else if (isset($_GET["text"]) && $_GET["text"] == "price") {
				?>
					<!-- Navigation för reseinfo -->
					<ul id="travelNav">
						<li id="descLink"><a href='resa.php?id=<?php echo $id; ?>&text=desc'>Beskrivning</a></li
						><li>
							<a id="planLink" href='resa.php?id=<?php echo $id; ?>&text=plan'>Reseupplägg</a>
						</li
						><li>
							<a id="priceLink" class="chosen" href='resa.php?id=<?php echo $id; ?>&text=price'>Pris</a>
						</li
						><li>
							<a id="photoLink" href='resa.php?id=<?php echo $id; ?>&text=photo'>Foton</a>
						</li>
				    </ul><!-- /#travelNav -->
				    <article>
				    	<h4>Pris från: </h4>
				    	<p><?php echo $price; ?> kr</p>
				    	<p>Extra avgifter tillkommer vid tillval, boende i enkelrum etc. Skicka in en bokningsförfrågan för mer information om olika alternativ.</p>
				    </article>
				<?php
				}
				else if (isset($_GET["text"]) && $_GET["text"] == "photo") {
				?>
					<!-- Navigation för reseinfo -->
					<ul id="travelNav">
						<li id="descLink"><a href='resa.php?id=<?php echo $id; ?>&text=desc'>Beskrivning</a></li
						><li>
							<a id="planLink" href='resa.php?id=<?php echo $id; ?>&text=plan'>Reseupplägg</a>
						</li
						><li>
							<a id="priceLink" href='resa.php?id=<?php echo $id; ?>&text=price'>Pris</a>
						</li
						><li>
							<a id="photoLink" class="chosen" href='resa.php?id=<?php echo $id; ?>&text=photo'>Foton</a>
						</li>
				    </ul><!-- /#travelNav -->
					<article>
					<?php
					// Om bilder finns ska dessa loopas fram
					if ($photo != false) {
						foreach ($photo as $photoKey) {
							// Skapar variabler
							$imageName = $photoKey['name'];
							$url = $photoKey['url'];
					?>
							<a class="fade" href="<?php __DIR__; ?>/images/travels/<?php echo $url; ?>.jpg" data-lightbox="<?php echo $name; ?>"><img src="<?php __DIR__; ?>/images/travels/thumb_<?php echo $url; ?>.jpg" alt="<?php echo $imageName; ?>"></a>
					<?php }} ?>
			    	</article>
			    <?php
				}
				?>
				</section><!-- "js-travel -->
				<?php
/*------------------------------------------------------------------------------------*/
				// Om besökaren precis kommit in på sidan ska följande navigation skrivas ut
				if (!isset($_GET["text"])) {
				?>
					<!-- Navigation för reseinfo -->
					<ul id="travelNav">
						<li id="descLink" class="chosen"><a href='resa.php?id=<?php echo $id; ?>&text=desc'>Beskrivning</a></li
						><li>
							<a id="planLink" href='resa.php?id=<?php echo $id; ?>&text=plan'>Reseupplägg</a>
						</li
						><li>
							<a id="priceLink" href='resa.php?id=<?php echo $id; ?>&text=price'>Pris</a>
						</li
						><li>
							<a id="photoLink" href='resa.php?id=<?php echo $id; ?>&text=photo'>Foton</a>
						</li>
				    </ul><!-- /#travelNav -->
				    <article id="desc">
				    	<p class="heading">Nästa avresa: <?php echo $date; ?></p>
				    	<?php echo $description; ?>
				    </article>
				<?php
				}
				?>
				<article id="plan">
				    <p class="heading">Avresedag: <?php echo $date; ?></p>
			    	<?php echo $itinerary; ?>
			    </article>
			    <article id="price">
			    	<h4>Pris från: </h4>
				    	<p><?php echo $price; ?> kr</p>
				    	<p>Extra avgifter tillkommer vid tillval, boende i enkelrum etc. Skicka in en bokningsförfrågan för mer information om olika alternativ.</p>
			    </article>
				<article id="photo">
				<?php
				// Om bilder finns ska dessa loopas fram
				if ($photo != false) {
					foreach ($photo as $photoKey) {
						// Skapar variabler
						$imageName = $photoKey['name'];
						$url = $photoKey['url'];
				?>
						<a class="fade" href="<?php __DIR__; ?>/images/travels/<?php echo $url; ?>.jpg" data-lightbox="<?php echo $name; ?>"><img src="<?php __DIR__; ?>/images/travels/thumb_<?php echo $url; ?>.jpg" alt="<?php echo $imageName; ?>"></a>
				<?php }} ?>
		    	</article>
			</section><!-- /.mainContainer -->
			<aside>
				<div id="map"></div>
				<?php
				// Om kundomdömen finns ska dessa loopas fram
				if ($report != false) {
				?>
					<section>
						<h3>Kundomdömen</h3>
						<?php
						foreach ($report as $reportKey) {
							// Skapar variabler
							$firstname = $reportKey['firstname'];
							$lastname = $reportKey['lastname'];
							$report = $reportKey['report'];
						?>
							<blockquote><i class="fa fa-quote-right" aria-hidden="true"></i> <?php echo $report; ?> <i class="fa fa-quote-right" aria-hidden="true"></i></blockquote>
							<p class="heading"><?php echo $firstname . " " . $lastname; ?></p>
						<?php } ?>
					</section>
				<?php } ?>
				<button id="bookingButton">Bokningsförfrågan</button>
				<section id="bookingSection">
					<h3>Bokningsförfrågan</h3>
					<form id="bookingForm" method="post">
						<label for="dest">Resmål*</label>
						<input type="text" name="dest" id="dest" value="<?php echo $name; ?>">
						<p class="error"><?php echo $destinationErr; ?></p>
						<label for="first_lastname">För- och efternamn*</label>
						<input type="text" placeholder="För- och efternamn" name="first_lastname" id="first_lastname" value="<?php echo $first_lastname; ?>">
						<p class="error"><?php echo $first_lastnameErr; ?></p>
						<label for="street">Gatuadress*</label>
						<input type="text" placeholder="Gatuadress (ex. Vägen 1)" name="street" id="street" value="<?php echo $street; ?>">
						<p class="error"><?php echo $streetErr; ?></p>
						<label for="address">Postadress*</label>
						<input type="text" placeholder="Postadress (ex. 111 11 Staden)" name="address" id="address" value="<?php echo $address; ?>">
						<p class="error"><?php echo $addressErr; ?></p>
						<label for="email">E-post*</label>
						<input type="email" placeholder="E-post" name="email" id="email" value="<?php echo $email; ?>">
						<p class="error"><?php echo $emailErr; ?></p>
						<label for="phone">Telefonnummer*</label>
						<input type="text" placeholder="Telefonnummer" name="phone" id="phone" value="<?php echo $phone; ?>">
						<p class="error"><?php echo $phoneErr; ?></p>
						<input type="submit" id="submitBooking" value="Skicka" name="submitBooking">
					</form>
				</section><!-- /#bookingSection -->
				<div id="bookingMessage"><?php echo $bookingMessage; ?></div>
			</aside>
<?php
include("includes/footer.php");
}
// Om resans id inte finns satt skickas besökaren till reseväljar-sidan
else {
    header("Location: resor.php");
    exit;
}
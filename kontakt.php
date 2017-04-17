<?php
/*
* Sara Petersson - Webbanvändbarhet, DT068G
* 
*/

// Undersidans titel
$page_title = "Kontakt";
// Hämtar in headern
include("includes/header.php");
// Skapar tomma variabler
$name = $email = $message = $nameErr = $emailErr = $messageErr = $contactMessage = '';
/*--------------------- För användare som inaktiverat javascript ---------------------*/
// Om användaren tryckt på "Skicka"-knapp valideras formulär
if (isset($_POST["submitMessage"])) {
    // Kollar om namn fyllts i
    if (empty($_POST['contact_name'])) {
        // Felmeddelande
        $nameErr = "För- och efternamn krävs";
    }
    else {
    	$name = $_POST['contact_name'];
    }
    // Kollar om e-post fyllts i
    if (empty($_POST['contact_email'])) {
        // Felmeddelande
        $emailErr = "E-post krävs";
    }
    else {
        // Skapar variabel
        $email = $_POST['contact_email'];
        // Kollar om e-mailaddressen inte är välformulerad
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Felmeddelande
            $emailErr = "Ogiltigt epost-format";
        }
    }
    // Kollar om meddelande skrivits
    if (empty($_POST['message_contact'])) {
        // Felmeddelande
        $messageErr = "Meddelande krävs";
    }
    else {
    	$message = $_POST['message_contact'];
    }
    // Om inga felmeddelanden är satta skickas bokningsförfrågan via mejl
    if ($nameErr == '' && $emailErr == '' && $messageErr == '') {
    	$message = $travel->sendMessage($name, $email, $message);
    	if ($message == true) {
    		$contactMessage = "<p class='message success'>Ditt meddelande har skickats och vi återkommer inom 24 timmar.</p>";
    	}
    	else {
    		$contactMessage = "<p class='message fail'>Tyvärr kunde inte ditt meddelande skickas. Vänligen försök igen eller kontakta oss på 01-234 56 78.</p>";
    	}
    }
}
/*------------------------------------------------------------------------------------*/
?>
	<script>
		// Sparar företagets koordinater till Google maps
		var lat = 59.331365;
		var lon = 18.068285;
	</script>
	<main>
	<section id="mainContent">
		<h2>Kontakt</h2>
		<section class="mainContainer">
			<p>Vår målsättning är att ge dig ditt livs äventyr. Kanske är det att vandra i Anderna, spana på fåglar i Indonesien eller upptäcka de skotska högländerna. Vad du än drömmer om, kan du vara säker på att Adventour kan förverkliga dem.</p>
            <h3>Mejla oss</h3>
			<p><a href="mailto:info@adventour.com">info@adventour.com</a></p>
            <h3>Ring oss</h3>
			<p>Kundtjänst vardagar kl. 9-17<br>
                01-234 56 78</p>
            <h3>Besök oss</h3>
            <p>Adventour AB<br>
                Vägen 1<br>
                111 11 Staden</p>
			<h3>Kontakta oss</h3>
            <!-- Kontaktformulär -->
			<form id="contactForm" method="post">
				<label for="contact_name">För- och efternamn*</label>
				<input type="text" placeholder="För- och efternamn" name="contact_name" id="contact_name" value="<?php echo $name; ?>">
				<p class="error"><?php echo $nameErr; ?></p>
				<label for="contact_email">E-post*</label>
				<input type="email" placeholder="E-post" name="contact_email" id="contact_email" value="<?php echo $email; ?>">
				<p class="error"><?php echo $emailErr; ?></p>
				<label for="message_contact">Meddelande*</label>
				<textarea placeholder="Ditt meddelande" name="message_contact" id="message_contact"></textarea>
				<p class="error"><?php echo $messageErr; ?></p>
				<input type="submit" id="submitMessage" value="Skicka" name="submitMessage">
			</form>
			<div id="contactMessage"><?php echo $contactMessage; ?></div>
		</section><!-- /.mainContainer -->
		<aside>
			<div id="map"></div>
		</aside>

<?php
include("includes/footer.php");
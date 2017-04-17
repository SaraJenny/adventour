<?php
/*
* Sara Petersson - Webbanvändbarhet, DT068G
* 
*/

// Undersidans titel
$page_title = "Resor";
// Hämtar in headern
include("includes/header.php");
// Hämtar information
$continent = $travel->getContinents();
$destinationList = $travel->getDestinations();
/*--------------------- För användare som inaktiverat javascript ---------------------*/
// Om knappen "Sök resor" är tryckt
if (isset($_REQUEST["submitTravel"])) {
	// Variabler
	$month = 0;
	$continentChoice = '';
    // Om inget resmålsval eller månadsval har gjorts hämtas alla resor
    if (empty($_REQUEST['continent']) && $_REQUEST['selectMonth'] == 0) {
	    $destinationList = $travel->getDestinations();
    }
    else {
    	// Sparar vald avresemånad
	    $month = $_REQUEST['selectMonth'];
	    // Om inget resmål har valts hämtas resor utifrån avresemånad
	    if (empty($_REQUEST['continent'])) {
	    	$destinationList = $travel->getDestinationsFromMonth($month);
	    }
	    else {
	    	// Sparar valda resmål
	    	$continentChoice = $_REQUEST['continent'];
	    	// Om både resmål och månad valts hämtas resor utifrån detta 
	    	if ($month != 0) {
	    		$destinationList = $travel->getDestinationsFromContintentAndMonth($continentChoice, $month);
	    	}
	    	// Om resmål har valts (men inte månad) hämtas resor utifrån kontinent
	    	else {
				$destinationList = $travel->getDestinationsFromContinent($continentChoice);
	    	}
	    }
	}
}
/*------------------------------------------------------------------------------------*/
?>
<main>
	<section id="mainContent">
		<h2>Resor</h2>
		<aside id="destination">
			<h3>Resmål</h3>
			<form id="destinationForm" method="get">
				<fieldset>
					<legend class="hidden">Kontinent</legend>
					<?php
					foreach ($continent as $key) {
					?>
						<input class="checkbox" type="checkbox" name="continent[]" id="<?php echo $key['continent_id']; ?>" value="<?php echo $key['continent_id']; ?>"
						<?php
							if (isset($_REQUEST["submitTravel"]) && $continentChoice != '') {
								foreach ($continentChoice as $continentChoiceKey) {
									if ($continentChoiceKey == $key['continent_id']) {
										echo 'checked="checked"';
									}
								}
							}
						?>><?php echo $key['continent']; ?><br>
						<label class="hidden" for="<?php echo $key['continent_id']; ?>"><?php echo $key['continent']; ?></label>
					<?php
					}
					?>
				</fieldset>
				<label for="selectMonth">Avresemånad</label>
				<select name="selectMonth" id="selectMonth">
					<option value="0">Välj månad</option>
					<option value="1" <?php if (isset($_REQUEST["submitTravel"]) && $month == 1) { echo "selected"; }?>>Januari</option>
					<option value="2" <?php if (isset($_REQUEST["submitTravel"]) && $month == 2) { echo "selected"; }?>>Februari</option>
					<option value="3" <?php if (isset($_REQUEST["submitTravel"]) && $month == 3) { echo "selected"; }?>>Mars</option>
					<option value="4" <?php if (isset($_REQUEST["submitTravel"]) && $month == 4) { echo "selected"; }?>>April</option>
					<option value="5" <?php if (isset($_REQUEST["submitTravel"]) && $month == 5) { echo "selected"; }?>>Maj</option>
					<option value="6" <?php if (isset($_REQUEST["submitTravel"]) && $month == 6) { echo "selected"; }?>>Juni</option>
					<option value="7" <?php if (isset($_REQUEST["submitTravel"]) && $month == 7) { echo "selected"; }?>>Juli</option>
					<option value="8" <?php if (isset($_REQUEST["submitTravel"]) && $month == 8) { echo "selected"; }?>>Augusti</option>
					<option value="9" <?php if (isset($_REQUEST["submitTravel"]) && $month == 9) { echo "selected"; }?>>September</option>
					<option value="10" <?php if (isset($_REQUEST["submitTravel"]) && $month == 10) { echo "selected"; }?>>Oktober</option>
					<option value="11" <?php if (isset($_REQUEST["submitTravel"]) && $month == 11) { echo "selected"; }?>>November</option>
					<option value="12" <?php if (isset($_REQUEST["submitTravel"]) && $month == 12) { echo "selected"; }?>>December</option>
				</select>
				<a id="clearFilter" href="resor.php"><i class="fa fa-times" aria-hidden="true"></i> Rensa filter</a>
				<input type="submit" value="Sök resor" name="submitTravel" id="submitTravel">
			</form>
		</aside>
		<section id="travelSection">
		<?php
		// Om "Sök resor" har tryckts och besökaren har klickat för minst ett resmål
		if (isset($_REQUEST["submitTravel"]) && !empty($_REQUEST['continent'])) {
			// Kollar om inga resor har hittats, och skriver i så fall ut ett felmeddelande
			$checkArray = array_filter($destinationList);
			if (empty($checkArray)) {
				echo "<p class='emptyMessage'>Inga resmål funna utifrån dina önskemål</p>";
			}
			// Loopar fram resor
			foreach ($destinationList as $destinations) {
				if ($destinations != NULL) {
					foreach ($destinations as $destinationKey) {
						// Hämtar utdrag
						$excerpt = getExcerpt($destinationKey['description']);
		?>
						<a href="resa.php?id=<?php echo $destinationKey['travel_id']; ?>">
							<article class="fade">
								<img src="<?php __DIR__; ?>/images/travels/<?php echo $destinationKey['image-teaser']; ?>.jpg" alt="">
								<h3><?php echo $destinationKey['name']; ?></h3>
								<p><?php echo $excerpt; ?> ...</p>
								<div class="infoSection">
									<div class="infoContainer">
										<p class="heading">Antal dagar</p>
										<p class="info"><?php echo $destinationKey['days']; ?></p>
									</div>
									<div class="infoContainer">
										<p class="heading">Avresa</p>
										<p class="info"><?php echo $destinationKey['dep_date']; ?></p>
									</div>
									<div class="infoContainer">
										<p class="heading">Pris från</p>
										<p class="info"><?php echo $destinationKey['price']; ?></p>
									</div>
									<div class="travelButton">Mer information</div>
								</div>
							</article>
						</a>
		<?php
					}
				}
			}
		}
		else {
			if (empty($destinationList)) {
				echo "<p class='emptyMessage'>Inga resmål funna utifrån dina önskemål</p>";
			}
			foreach ($destinationList as $destinationKey) {
				// Hämtar utdrag
				$excerpt = getExcerpt($destinationKey['description']);
		?>
				<a href="resa.php?id=<?php echo $destinationKey['travel_id']; ?>">
					<article class="fade">
						<img src="<?php __DIR__; ?>/images/travels/<?php echo $destinationKey['image-teaser']; ?>.jpg" alt="">
						<h3><?php echo $destinationKey['name']; ?></h3>
						<p><?php echo $excerpt; ?> ...</p>
						<div class="infoSection">
							<div class="infoContainer">
								<p class="heading">Antal dagar</p>
								<p class="info"><?php echo $destinationKey['days']; ?></p>
							</div>
							<div class="infoContainer">
								<p class="heading">Avresa</p>
								<p class="info"><?php echo $destinationKey['dep_date']; ?></p>
							</div>
							<div class="infoContainer">
								<p class="heading">Pris från</p>
								<p class="info"><?php echo $destinationKey['price']; ?></p>
							</div>
							<div class="travelButton">Mer information</div>
						</div>
					</article><!-- / -->
				</a>
		<?php
			}
		}
		?>
		</section><!-- /#travelSection -->
		<a id="up" href="#headerSection"><i class="fa fa-arrow-up" aria-hidden="true"></i> Till toppen</a>
<?php
include("includes/footer.php");
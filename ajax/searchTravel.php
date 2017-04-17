<?php
/*
* Sara Petersson - Webbanvändbarhet, DT068G
* 
*/

// Läser in config-filen
include("../includes/config.php");

// Kollar att alla parametrar har satts
if(isset($_POST['continents']) && isset($_POST['month'])) {
	$continents = $_POST['continents'];
    $continents = explode(", ", $continents);
	$month = $_POST['month'];
	// Om ingen månad har valts hämtas resmål utifrån kontinent
    if ($month == 0) {
        $result = $travel->getDestinationsFromContinent($continents);
    }
    // Om månad har valts hämtas resmål utifrån kontinent och månad
    else {
        $result = $travel->getDestinationsFromContintentAndMonth($continents, $month);
    }
    // Loopar igenom resultatet och skriver ut resmål
    foreach ($result as $dest) {
        if ($dest != NULL) {
            foreach ($dest as $destinationKey) {
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
        // Om inga resmål hittas
        else {
            echo false;
        }
    }
}
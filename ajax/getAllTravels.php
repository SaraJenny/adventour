<?php
/*
* Sara Petersson - Webbanvändbarhet, DT068G
* 
*/

// Läser in config-filen
include("../includes/config.php");

// Hämtar alla resor
$result = $travel->getDestinations();
if ($result != NULL) {
    foreach ($result as $destinationKey) {
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
// Om inga resor hittas
else {
    echo false;
}
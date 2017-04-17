<?php
/*
* Sara Petersson - Webbanvändbarhet, DT068G
* 
*/
// Startar session
session_start();
// Webbplatsens titel
$site_title = "Adventour";
// Webbplatsens avdelare
$divider = " | ";
//Funktion som hämtar sökväg
function getPath() {
    $path = $_SERVER['PHP_SELF'];
    return $path;
}
// Funktion som hämtar utdrag
function getExcerpt($description) {
	// Avkodar html-entiteter så att de skrivs ut korrekt
	$description = html_entity_decode($description);
	// Tar bort taggar för att dessa inte ska brytas mitt av
	$content = strip_tags($description);
	// Begränsar till 250 tecken
	$excerpt = substr($content, 0, 190);
	return $excerpt;
}
// Aktiverar autoload för att snabba upp registrering av klasser
spl_autoload_register(function ($classObject) {
    include __DIR__.'/class/' . $classObject . '.class.php';
});
// Skapar objekt
$travel = new Travel();
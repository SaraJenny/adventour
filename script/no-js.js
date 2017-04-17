/*
* Sara Petersson - Webbanvändbarhet, DT068G
* Då javascript är aktiverat ändras utseende
*/

// Sparar den aktuella sidan
var pathname = window.location.pathname;

/* -------------- RESOR.PHP --------------- */
if (pathname == "/resor.php") {
	// Döljer "Sök resor"-knapp
	document.getElementById("submitTravel").style.display = "none";
}

/* -------------- RESA.PHP --------------- */
if (pathname == "/resa.php") {
	// Visar bokningsknapp
	document.getElementById("bookingButton").style.display = "block";
	// Döljer bokningssektion
	document.getElementById("bookingSection").style.display = "none";
}
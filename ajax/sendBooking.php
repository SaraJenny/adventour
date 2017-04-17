<?php
/*
* Sara Petersson - Webbanvändbarhet, DT068G
* 
*/

// Läser in config-filen
include("../includes/config.php");

// Kollar att alla parametrar har satts
if(isset($_POST['destination']) && isset($_POST['name']) && isset($_POST['street']) && isset($_POST['address']) && isset($_POST['email']) && isset($_POST['phone'])) {
	$destination = $_POST['destination'];
	$name = $_POST['name'];
    $street = $_POST['street'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $result = $travel->bookTravel($destination, $name, $street, $address, $email, $phone);
    if ($result == true) {
        echo true;
    }
    else {
        echo false;
    }
}
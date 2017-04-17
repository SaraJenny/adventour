<?php
/*
* Sara Petersson - Webbanvändbarhet, DT068G
* 
*/

// Läser in config-filen
include("../includes/config.php");

// Kollar att alla parametrar har satts
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
	$name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $result = $travel->sendMessage($name, $email, $message);
    if ($result == true) {
        echo true;
    }
    else {
        echo false;
    }
}
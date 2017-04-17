<?php
/*
* Sara Petersson - Webbanvändbarhet, DT068G
* 
*/

class Travel {

	public function __construct() {
		$this->db = new Database();
	}

	// Hämtar namn på kontinenter
	public function getContinents() {
		$result = $this->db->select("SELECT * FROM continent");
		return $result;
	}

	// Hämtar resmål
	public function getDestinations() {
		$result = $this->db->select("SELECT * FROM travel ORDER BY dep_date ASC");
		return $result;
	}

	// Hämtar resmål efter avresemånad
	public function getDestinationsFromMonth($month) {
		$result = $this->db->select("SELECT * FROM travel WHERE month = $month ORDER BY dep_date ASC");
		return $result;
	}

	// Hämtar resmål efter kontinent
	public function getDestinationsFromContinent($continent) {
		foreach ($continent as $continent_id) {
				$result[] = $this->db->select("SELECT * FROM travel WHERE continent_id = $continent_id ORDER BY dep_date ASC");
			}
		return $result;
	}

	// Hämtar resmål efter kontinent och avresemånad
	public function getDestinationsFromContintentAndMonth($continent, $month) {
		foreach ($continent as $continent_id) {
				$result[] = $this->db->select("SELECT * FROM travel WHERE continent_id = $continent_id AND month = $month ORDER BY dep_date ASC");
			}
		return $result;
	}

	// Hämtar resmål från dess id
	public function getTravel($id) {
		$result = $this->db->select("SELECT * FROM travel WHERE travel_id = $id");
		if ($result) {
			return $result;
		}
		else {
			return false;
		}
	}

	// Hämtar foton från dess id
	public function getPhotos($id) {
		$result = $this->db->select("SELECT * FROM images WHERE travel_id = $id");
		if ($result) {
			return $result;
		}
		else {
			return false;
		}
	}

	// Hämtar kundomdömen för specifik resa, begränsat till de två senaste omdömena
	public function getReports($id) {
		$result = $this->db->select("SELECT * FROM report WHERE travel_id = $id ORDER BY report_id DESC LIMIT 2");
		if ($result) {
			return $result;
		}
		else {
			return false;
		}
	}

	// Skicka bokningsförfrågan
	public function bookTravel($name, $first_lastname, $street, $address, $email, $phone) {
		// Saniterar all data
		$name = $this->db->sanitize($name);
		$first_lastname = $this->db->sanitize($first_lastname);
		$street = $this->db->sanitize($street);
		$address = $this->db->sanitize($address);
		$email = $this->db->sanitize($email);
		$phone = $this->db->sanitize($phone);

		$from = "Från: " . $first_lastname;
		$to = "sara@doggie-zen.se";
		$subject = "Bokningsförfrågan: " . $name;
		$body = "Resmål: " . $name . "\nNamn: " . $first_lastname . "\nGatuadress: " . $street . "\nPostadress: " . $address . "\nE-post: " . $email . "\nTelefon: " . $phone;
		if (mail($to, $subject, $body, $from)) {
			return true;
		}
		else {
			return false;
		}
	}

	// Skicka meddelande
	public function sendMessage($name, $email, $message) {
		// Saniterar all data
		$name = $this->db->sanitize($name);
		$email = $this->db->sanitize($email);
		$message = $this->db->sanitize($message);

		$from = "Från: " . $name;
		$to = "sara@doggie-zen.se";
		$subject = "Meddelande från " . $name;
		$body = "Namn: " . $name . "\nE-post: " . $email . "\nMeddelande: " . $message;
		if (mail($to, $subject, $body, $from)) {
			return true;
		}
		else {
			return false;
		}
	}
}
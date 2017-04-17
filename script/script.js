/*
* Sara Petersson - Webbanvändbarhet, DT068G
* 
*/
/* Google maps */
function initMap() {
    var mapDiv = document.getElementById('map');
    var map = new google.maps.Map(mapDiv, {
      center: {lat: lat, lng: lon},
      zoom: 6
    });
}
$(document).ready(function() {
    /* RESOR.PHP */
    /* Då användaren klickar på "Rensa filter" töms formuläret */
    $('#clearFilter').click(function(event) {
        event.preventDefault();
        $('.checkbox:checked').removeAttr('checked');
        $('#selectMonth').val(0);
        // AJAX-anrop
        $.ajax({
            method: 'POST',
            url: 'ajax/getAllTravels.php',
        }).done(function(result) {
            // Skriver ut alla resor
            if (result != false) {
                $('.emptyMessage').remove();
                $('#travelSection a').remove();
                $('#travelSection').append(result);
            }
            // Skriver ut meddelande
            else {
                $('.emptyMessage').remove();
                $('#travelSection a').remove();
                $('#travelSection').append("<p class='emptyMessage'>Inga resmål funna utifrån dina önskemål</p>");
            }
        });
    });
	// Då användaren klickar på en checkbox skickas den till en funktion som hämtar resor som uppfyller användarens önskemål
	$('.checkbox').on('change', function() {
		getTravels();
	});
	// Då användaren väljer avresemånad skickas den till en funktion som hämtar resor som uppfyller användarens önskemål
	$('#selectMonth').on('change', function() {
		getTravels();
	});
	// Funktion som hämtar resor som uppfyller användarens önskemål
	function getTravels() {
		// Hämtar valda resmål
		var continents = $('.checkbox:checked').map(function() {
			return $(this).val();
		})
		.get()
		.join(", ");
        // Om inget resmål har valts ska alla resmål tas med
        if (continents == '') {
            continents = "1, 2, 3, 4, 5, 6, 7"
        }
		// Hämtar värde på avresemånad
		var month = $('#selectMonth').val();
		// AJAX-anrop
        $.ajax({
            method: 'POST',
            url: 'ajax/searchTravel.php',
            data: {
                continents: continents,
                month: month
            }
        }).done(function(result) {
        	// Skriver ut resor som uppfyller önskemål
        	if (result != false) {
            	$('.emptyMessage').remove();
            	$('#travelSection a').remove();
            	$('#travelSection').append(result);
            }
            // Skriver ut meddelande
            else {
            	$('.emptyMessage').remove();
            	$('#travelSection a').remove();
            	$('#travelSection').append("<p class='emptyMessage'>Inga resmål funna utifrån dina önskemål</p>");
            }
        });
	}
    /* RESA */
    // Klick på beskrivningslänk
    $('#descLink').click(function(event) {
        event.preventDefault();
        $('#plan').hide();
        $('#price').hide();
        $('#photo').hide();
        $('#desc').show();
        $('#planLink').removeClass('chosen');
        $('#priceLink').removeClass('chosen');
        $('#photoLink').removeClass('chosen');
        $('#descLink').addClass('chosen');
    });
    // Klick på reseuppläggslänk
    $('#planLink').click(function(event) {
        event.preventDefault();
        $('#desc').hide();
        $('#price').hide();
        $('#photo').hide();
        $('#plan').show();
        $('#descLink').removeClass('chosen');
        $('#priceLink').removeClass('chosen');
        $('#photoLink').removeClass('chosen');
        $('#planLink').addClass('chosen');
    });
    // Klick på prislänk
    $('#priceLink').click(function(event) {
        event.preventDefault();
        $('#desc').hide();
        $('#plan').hide();
        $('#photo').hide();
        $('#price').show();
        $('#descLink').removeClass('chosen');
        $('#planLink').removeClass('chosen');
        $('#photoLink').removeClass('chosen');
        $('#priceLink').addClass('chosen');
    });
    // Klick på fotolänk
    $('#photoLink').click(function(event) {
        event.preventDefault();
        $('#desc').hide();
        $('#plan').hide();
        $('#price').hide();
        $('#photo').show();
        $('#descLink').removeClass('chosen');
        $('#planLink').removeClass('chosen');
        $('#priceLink').removeClass('chosen');
        $('#photoLink').addClass('chosen');
    });
    // Vid klick på "Boka resa" fälls bokningsformulär ut och knappen försvinner
    $('#bookingButton').click(function() {
        $("#bookingButton").hide();
        $('#bookingSection').toggle('slow');
    });
    // Vid klick på "Skicka", valideras formuläret och skickas
    $('#submitBooking').click(function(event) {
        event.preventDefault();
        $('.message').remove();
        // Radera ev. felmeddelanden
        $(".error").remove();
        var destination = $('#dest').val();
        var name = $('#first_lastname').val();
        var street = $('#street').val();
        var address = $('#address').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        hasError = validateBooking(destination, name, street, address, email, phone);
        // Om inga fel hittas görs ett AJAX-anrop för att skicka bokningsförfrågan
        if (hasError == false) {
            $.ajax({
                method: 'POST',
                url: 'ajax/sendBooking.php',
                data: {
                    destination: destination,
                    name: name,
                    street: street,
                    address: address,
                    email: email,
                    phone: phone
                }
            }).done(function(result) {
                /* Om bokningsförfrågan kunde skickas töms formuläret och ett meddelande skrivs ut */
                if (result == true) {
                    $('#bookingButton').show();
                    $('#bookingSection').toggle();
                    $('#dest').val('');
                    $('#first_lastname').val('');
                    $('#street').val('');
                    $('#address').val('');
                    $('#email').val('');
                    $('#phone').val('');
                    $('#bookingMessage').append('<p class="message success">Din bokningsförfrågan är skickad och vi återkommer inom 24 timmar.</p>')
                }
                // Om bokningsförfrågan inte kunde skickas skrivs ett felmeddelande ut
                else {
                    $('#bookingMessage').append('<p class="message fail">Tyvärr kunde inte din bokningsförfrågan skickas. Vänligen försök igen eller kontakta oss på 01-234 56 78</p>');
                }
            });
        }
    });
    /* KONTAKT.PHP */
    // Vid klick på "Skicka", valideras formuläret och skickas
    $('#submitMessage').click(function(event) {
        event.preventDefault();
        $('.message').remove();
        // Radera ev. felmeddelanden
        $(".error").remove();
        var name = $('#contact_name').val();
        var email = $('#contact_email').val();
        var message = $('#message_contact').val();
        hasError = validateContact(name, email, message);
        // Om inga fel hittas görs ett AJAX-anrop för att skicka bokningsförfrågan
        if (hasError == false) {
            $.ajax({
                method: 'POST',
                url: 'ajax/sendMessage.php',
                data: {
                    name: name,
                    email: email,
                    message: message
                }
            }).done(function(result) {
                /* Om kontaktformuläret kunde skickas töms formuläret och ett meddelande skrivs ut */
                if (result == true) {
                    $('#contact_name').val('');
                    $('#contact_email').val('');
                    $('#message_contact').val('');
                    $('#contactMessage').append('<p class="message success">Ditt meddelande har skickats och vi återkommer inom 24 timmar.</p>')
                }
                // Om bokningsförfrågan inte kunde skickas skrivs ett felmeddelande ut
                else {
                    $('#contactMessage').append('<p class="message fail">Tyvärr kunde inte ditt meddelande skickas. Vänligen försök igen eller kontakta oss på 01-234 56 78.</p>');
                }
            });
        }
    });
    /* FUNKTIONER */
    // Kontrollerar användarinformation
    function validateContact(name, email, message) {
        var hasError = false;
        // Kollar att fältet inte är tomt
        if (name == '') {
            $('<p class="error">Du måste fylla i för- och efternamn</p>').insertAfter('#contact_name');
            hasError = true;
        }
        // Kollar att fältet inte är tomt
        if (email == '') {
            $('<p class="error">Du måste fylla i din e-post</p>').insertAfter('#contact_email');
            hasError = true;
        }
        else {
            // Validerar e-posten genom funktionen validateEmail()
            var valid = validateEmail(email);
            if (valid != true) {
                $('<p class="error">Ogiltigt e-postformat</p>').insertAfter('#contact_email');
                hasError = true;
            }
        }
        // Kollar att fältet inte är tomt
        if (message == '') {
            $('<p class="error">Du måste skriva ett meddelande</p>').insertAfter('#message_contact');
            hasError = true;
        }
        // Returnerar resultatet av hasError
        return hasError;
    }
    // Kontrollerar användarinformation
    function validateBooking(destination, name, street, address, email, phone) {
        var hasError = false;
        // Kollar att fältet inte är tomt
        if (destination == '') {
            $('<p class="error">Du måste fylla i resmål</p>').insertAfter('#dest');
            hasError = true;
        }
        // Kollar att fältet inte är tomt
        if (name == '') {
            $('<p class="error">Du måste fylla i ditt namn</p>').insertAfter('#first_lastname');
            hasError = true;
        }
        // Kollar att fältet inte är tomt
        if (street == '') {
            $('<p class="error">Du måste fylla i din gatuadress</p>').insertAfter('#street');
            hasError = true;
        }
        // Kollar att fältet inte är tomt
        if (address == '') {
            $('<p class="error">Du måste fylla i din postadress</p>').insertAfter('#address');
            hasError = true;
        }
        // Kollar att fältet inte är tomt
        if (email == '') {
            $('<p class="error">Du måste fylla i din e-post</p>').insertAfter('#email');
            hasError = true;
        }
        else {
            // Validerar e-posten genom funktionen validateEmail()
            var valid = validateEmail(email);
            if (valid != true) {
                $('<p class="error">Ogiltigt e-postformat</p>').insertAfter('#email');
                hasError = true;
            }
        }
        // Kollar att fältet inte är tomt
        if (phone == '') {
            $('<p class="error">Du måste fylla i ditt telefonnummer</p>').insertAfter('#phone');
            hasError = true;
        }
        // Returnerar resultatet av hasError
        return hasError;
    }
    // Validerar e-post och returnerar 'true' eller 'false'
    function validateEmail(email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test(email);
    }
});
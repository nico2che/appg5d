function creation() {
	var input = document.getElementById('localisationAutoCompletion');
	var options = {
		componentRestrictions: {country: 'fr'}
	};
	autocomplete = new google.maps.places.Autocomplete(input, options);
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();
        console.log(place.geometry.location.lat(), place.geometry.location.lng())
        document.getElementById('localisation_la').value = place.geometry.location.lat();
        document.getElementById('localisation_lo').value = place.geometry.location.lng();
    });
}
google.maps.event.addDomListener(window, 'load', creation);
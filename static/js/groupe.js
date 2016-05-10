function creation() {
	var input = document.getElementById('localisationAutoCompletion');
	var options = {
		componentRestrictions: {country: 'fr'}
	};
	autocomplete = new google.maps.places.Autocomplete(input, options);
}
google.maps.event.addDomListener(window, 'load', creation);
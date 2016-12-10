function initMap() {

	var lat = parseFloat($('#Lat').html());
	var lon = parseFloat($('#Lon').html());

	var rest = {lat: lat, lng: lon};
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 17,
		center: rest
	});
	var marker = new google.maps.Marker({
		position: rest,
		map: map
	});
}

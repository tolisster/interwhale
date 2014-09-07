$(document).ready(function() {
	$(".input-group > .form-control").focus(function(e) {
		$(this).parent().addClass("input-group-focus");
	}).blur(function(e) {
		$(this).parent().removeClass("input-group-focus");
	});
	if ($('#map-container').length) {
		function init_map() {
			var latLng = new google.maps.LatLng(34.1212999, -118.1150545);
			var mapOpt = {
				center: latLng,
				zoom: 10,
				disableDefaultUI: true
			};
			var marker = new google.maps.Marker({
				position: latLng,
				map: map,
				title:"Venice"
			});
			var map = new google.maps.Map(document.getElementById("map-container"), mapOpt);
			marker.setMap(map);
		}
		google.maps.event.addDomListener(window, 'load', init_map);
	}
	/*$('.random-users .panel-body').slick({
		//setting-name: setting-value
	});*/
});

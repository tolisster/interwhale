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
	$('#sidebar form select.form-control').on('change', function() {
		this.form.submit();
	});
	$('#main-content .panel .panel-heading .btn').on('click', function(event) {
		event.preventDefault();
		var $btn = $(this);
		$.get($btn.data('src'), function(data) {
			$btn.closest('.panel-heading').next().replaceWith('<div class="panel-body">' + data + '</div>');
			if ($btn.closest('.panel').data('name') == 'info') {
				var parts = $('#birthdate-profile-edit').val().split('-');
				if (parts.length == 3) {
					$('#month-birthdate-profile-edit').val(parseInt(parts[1]));
					$('#day-birthdate-profile-edit').val(parseInt(parts[2]));
					$('#year-birthdate-profile-edit').val(parts[0]);
				}

				$('#state-profile-edit').closest('.form-group').toggle($('#country-profile-edit').val() == 'US');
				$('#country-profile-edit').on('change', function() {
					$('#state-profile-edit').closest('.form-group').toggle($('#country-profile-edit').val() == 'US');
				});
			}
		});
	});
	function setError($field, text) {
		$field.closest('.form-group').addClass('has-error');
		$('<span/>').addClass('help-block').text(text).insertAfter($field);
		$field.focus();
	}
	$('#main-content .panel[data-name]').on('submit', '.panel-body form', function(event) {
		event.preventDefault();
		var $form = $(this);
		$form
			.find('.has-error').removeClass('has-error').end()
			.find('.help-block').remove();
		if ($form.closest('.panel').data('name') == 'info') {
			var year = $('#year-birthdate-profile-edit').val();
			var month = $('#month-birthdate-profile-edit').val();
			if (month.length == 1)
				month = '0' + month;
			var day = $('#day-birthdate-profile-edit').val();
			if (day.length == 1)
				day = '0' + day;
			$('#birthdate-profile-edit').val(year + '-' + month + '-' + day);
		}
		var formSerialized = $form.serializeArray();
		$.post($form.attr('action'), $.param(formSerialized), function(data) {
			$form.closest('.panel-body').replaceWith(data);
		}).fail(function(jqXHR) {
			try {
				var contentType = jqXHR.getResponseHeader('Content-Type');
				if (contentType.indexOf('application/json') == 0) {
					var data = $.parseJSON(jqXHR.responseText);
					$.each(data.errors, function(name, text) {
						setError($form.find('[name="' + name + '"]'), text);
					});
				}
			} catch(e) {
			}
		});
	});
});

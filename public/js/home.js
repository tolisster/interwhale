$(document).ready(function() {
	if ($('#apps-block').is(':visible')) {
		$("#apps-block > button").hover(function() {
			$(this).stop(true, false).animate({right: "0px"});
		}, function() {
			$(this).stop(true, false).animate({right: "-119px"});
		});
	}

	var image = new Image();
	image.onload = function () {
		var canvas = $('<canvas/>').get(0);
		canvas.width = image.width;
		canvas.height = image.height;
		var ctx = canvas.getContext('2d');
		ctx.drawImage(image, 0, 0, image.width, image.height);
		var q = 6.05;
		var countX = Math.floor(image.width / q);
		var countY = Math.floor(image.height / q);
		for (var i = 0; i < 100; i++) {
			var n = 0;
			do {
				var posX = Math.round(Math.floor(Math.random() * countX) * q - 4);
				var posY = Math.round(Math.floor(Math.random() * countY) * q - 6);
				var pixelData = ctx.getImageData(posX + 4, posY + 4, 1, 1).data;
				n++;
			} while(pixelData[1] == 0 && n < 100);
			var $light = $('<div></div>').css({left: posX, top: posY});
			var isAlight = true;//Math.floor(Math.random() * 2) == 1;
			if (isAlight)
				$light.hide();
			$light.appendTo('#map > div');
		}
		var duration = 1000;
		$('#map > div > div').slice(1, 4).fadeOut(duration, function showNext() {
			var isOut = Math.floor(Math.random() * 2) == 1;
			var $nextLight = $(this).next('div');
			if ($nextLight.is(':visible'))
				$nextLight.fadeOut(duration, showNext);
			else
				$nextLight.fadeIn(duration, showNext);
		});
	}
	image.src = "/images/map.png";

	if ($('#run-text-block').is(':visible')) {
		var duration = 1000;
		$('#run-text-block > h1:nth-child(1)').show().animate({
			opacity: 1,
			marginLeft: 0
		}, duration, function showNext() {
			$(this).next('h1').show().animate({
				opacity: 1,
				marginLeft: 0
			}, duration, showNext);
		});
	}

	if ($('#last-connections').is(':visible')) {
		$('#last-connections .list-group-item:nth-child(2)')
			.css({opacity: 0.5});
		var duration = 'slow';
		function showNextConnection() {
			$('#last-connections .list-group-item:last')
				.hide()
				.css({opacity: 0.0})
				.prependTo('#last-connections')
				.slideDown(duration, function() {
					setTimeout(showNextConnection, 5000);
				})
				.animate({opacity: 1.0}, duration);
			$('#last-connections .list-group-item:nth-child(2)')
				.animate({opacity: 0.5}, duration);
		}
		showNextConnection();
	}

	$('#register form').submit(function() {
		var btn = $(this).find('.btn-primary');
		btn.button('loading');
	});
});

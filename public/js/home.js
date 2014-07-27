$(document).ready(function() {
	if ($('#run-text-list').is(':visible')) {
		var i = 0;
		$('#run-text-list > li').textillate({
			autoStart: false,
			in: {
				effect: 'fadeInRight',
				sync: true,
				callback: function () {
					i++;
					if (!$('#run-text-list > li').eq(i).length)
						return;
					$('#run-text-list > li').eq(i).textillate('start');
				}
			}
		});
		$('#run-text-list > li').eq(i).textillate('start');
	}
	$("#apps-block > button").hover(function() {
		$(this).stop(true, false).animate({right: "0px"});
	}, function() {
		$(this).stop(true, false).animate({right: "-190px"});
	});
	$('#main-buttons > div:nth-child(1) > .btn').click(function() {
		var $div = $(this).parent();
		if ($div.is('.active')) {
			$('#signin-block').slideUp(duration, function() {
				$div.removeClass('active');
			});
		} else {
			$div.addClass('active');
			$('#signin-block').slideDown(duration);
		}
	});
	var image = new Image();
	image.onload = function () {
		var canvas = $('<canvas/>').get(0);
		canvas.width = image.width;
		canvas.height = image.height;
		var ctx = canvas.getContext('2d');
		ctx.drawImage(image, 0, 0, image.width, image.height);
		var q = 8.64;
		for (var i = 0; i < 100; i++) {
			do {
				var posX = Math.round(Math.floor(Math.random() * 132) * q + 0.6);
				var posY = Math.round(Math.floor(Math.random() * 67) * q - 0.9);
				var pixelData = ctx.getImageData(posX + 4, posY + 4, 1, 1).data;
			} while(pixelData[0] == 0);
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
		/*var i = 0;
		$('#run-text-list > li').textillate({
			autoStart: false,
			in: {
				effect: 'fadeInRight',
				sync: true,
				callback: function () {
					i++;
					if (!$('#run-text-list > li').eq(i).length)
						return;
					$('#run-text-list > li').eq(i).textillate('start');
				}
			}
		});
		$('#run-text-list > li').eq(i).textillate('start');*/
	}
});

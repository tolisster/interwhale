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

	var $avatar = $('.panel .panel-body .avatar');
	if ($avatar.length) {
		function setCoords(c) {
			$('#crop-avatar-profile-edit').val(c.x + ',' + c.y + ',' + c.w + ',' + c.h);
		}
		var avatarWidth = $avatar.attr('width');
		var avatarHeight = $avatar.attr('height');
		var selectionWidth = 110;
		var selectionHeight = 110;
		var x = avatarWidth / 2 - selectionWidth / 2;
		var y = avatarHeight / 2 - selectionHeight / 2;
		$avatar.Jcrop({
			onSelect: setCoords,
			onChange: setCoords,
			aspectRatio: 1 / 1,
			minSize: [selectionWidth, selectionHeight],
			setSelect: [x, y, x + selectionWidth, y + selectionHeight]
		});
	}
	$('#user-menu li a').on('click', function(event) {
		var $a = $(this);
		if ($a.data('method') == 'post') {
			event.preventDefault();
			$.post($a.attr('href'), $a.data('body'), function(data) {
			});
		} else if ($a.data('method') == 'get') {
			event.preventDefault();
			$.get($a.attr('href'), function(data) {
				$('#main-content').html(data);
			});
		}
	});

	$('body').on('click', '.btn[data-loading-text]', function() {
		var btn = $(this);
		btn.button('loading');
	});

	if ($('#country-profile-edit').length) {
		$('#state-profile-edit').closest('.form-group').toggle($('#country-profile-edit').val() == 'US');
		$('#country-profile-edit').on('change', function() {
			$('#state-profile-edit').closest('.form-group').toggle($('#country-profile-edit').val() == 'US');
		});
	}

	var originalLeave = $.fn.popover.Constructor.prototype.leave;
	$.fn.popover.Constructor.prototype.leave = function(obj){
		var self = obj instanceof this.constructor ?
			obj : $(obj.currentTarget)[this.type](this.getDelegateOptions()).data('bs.' + this.type)
		var container, timeout;

		originalLeave.call(this, obj);

		if(obj.currentTarget) {
			container = self.options.container ?
				$(self.options.container).children('.popover') : $(obj.currentTarget).siblings('.popover');
			timeout = self.timeout;
			container.one('mouseenter', function(){
				//We entered the actual popover – call off the dogs
				clearTimeout(timeout);
				//Let's monitor popover content instead
				container.one('mouseleave', function(){
					$.fn.popover.Constructor.prototype.leave.call(self, self);
				});
			})
		}
	};

	$('.navbar-nav a[data-toggle="popover"]').popover({
		delay: {show: 50, hide: 100},
		template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content list-group"></div></div>',
		trigger: 'hover',
		placement: 'bottom',
		container: '.navbar',
		html: true,
		content: function () {
			var $a = $(this);
			var $contentPopover = $a.next('.content-popover');
			if (!$contentPopover.children().length)
				return;
			if ($a.parent().is("[data-item=alerts]")) {
				var ids = [];
				$contentPopover.children().each(function() {
					ids.push($(this).data('id'));
				});
				$.ajax({
					type: "DELETE",
					url: '/alerts/' + ids
				});
			}
			return $contentPopover.html();
		}
	});

	if ($('html').data('user')) {
		/*Pusher.log = function(message) {
			if (window.console && window.console.log) {
				window.console.log(message);
			}
		};*/

		var pusher = new Pusher('b80544fb99d1bd1cbdee');
		var channel = pusher.subscribe('user-' + $('html').data('user'));
		channel.bind('friend-request', function(data) {
			var count = parseInt($('.navbar-nav [data-item=friends] .badge').text()) || 0;
			$('.navbar-nav [data-item=friends] .badge').text(count + 1);
			$('.navbar-nav [data-item=friends] .content-popover').html(data.view);
		});
		channel.bind('friend-added', function(data) {
			var $addFriend = $('[data-add-friend-code=' + data.code + ']');
			$addFriend.text($addFriend.data('add-friend-text'));
		});
		channel.bind('friend-accepted', function(data) {
			var count = parseInt($('.navbar-nav [data-item=alerts] .badge').text()) || 0;
			$('.navbar-nav [data-item=alerts] .badge').text(count + 1);
			$('.navbar-nav [data-item=alerts] .content-popover').html(data.view);
		});
		channel.bind('alert-deleted', function(data) {
			$('.navbar-nav [data-item=alerts] .badge').text('');
			$('.navbar-nav [data-item=alerts] .content-popover').html('');
		});
		channel.bind('chat-message-send', function(data) {
			if ($('.panel-chat[data-code=' + data.code + '] .list-group').length)
				$('.panel-chat[data-code=' + data.code + '] .list-group').append(data.view);
			else if ($('#sidebar .list-group a[data-code=' + data.code + ']').length) {
				var count = parseInt($('#sidebar .list-group a[data-code=' + data.code + '] .badge').text()) || 0;
				$('#sidebar .list-group a[data-code=' + data.code + '] .badge').text(count + 1);
			} else {
				var count = parseInt($('.navbar-nav [data-item=messages] .badge').text()) || 0;
				$('.navbar-nav [data-item=messages] .badge').text(count + 1);
				$('.navbar-nav [data-item=messages] .content-popover').html(data.alert);
			}
		});
		channel.bind('chat-message-sent', function(data) {
			$('.panel-chat[data-code=' + data.code + '] .list-group').append(data.view);
		});
		channel.bind('chat-call', function(data) {
			if ($('.panel-chat[data-code=' + data.code + '] .list-group').length) {
				$('<div class="center-block" style="width: 264px"><div id="publisherElement"></div></div>').insertBefore('.panel-chat .list-group');

				$.post('/chat/' + data.code, 'sessionId=' + data.sessionId, function(data) {
					var apiKey    = "16819511";

					var session = OT.initSession(apiKey, data.sessionId);

					session.on("streamCreated", function(event) {
						session.subscribe(event.stream);
					});

					session.connect(data.token, function(error) {
						var publisher = OT.initPublisher();
						session.publish(publisher);
					});
				});
			} else {
				$('.modal .modal-body').html(data.view);
				$('.modal .btn.btn-primary').attr('href', '/chat/' + data.code +
					'?call=true&session=' + data.sessionId);
				$('.modal').modal();
			}
		});
	}

	$('form[data-type=ajax]').on('submit', function(event) {
		event.preventDefault();
		var $form = $(this);
		var formSerialized = $form.serializeArray();
		$form.find(':input:not(:disabled)').prop('disabled',true);
		$.post($form.attr('action'), $.param(formSerialized), function() {
			$form.get(0).reset();
			$form.find(':input:disabled').prop('disabled',false);
		});
	});

	$('a[data-call-code]').on('click', function(event) {
		event.preventDefault();
		var $a = $(this);
		if ($('.panel-chat[data-code=' + $a.data('call-code') + ']').length) {
			$('<div class="center-block" style="width: 264px"><div id="publisherElement"></div></div>').insertBefore('.panel-chat .list-group');

			$.post('/chat/' + $a.data('call-code'), 'call=true', function(data) {
				var apiKey    = "16819511";

				var session = OT.initSession(apiKey, data.sessionId);

				session.on("streamCreated", function(event) {
					session.subscribe(event.stream);
				});

				session.connect(data.token, function(error) {
					var publisher = OT.initPublisher('publisherElement');
					session.publish(publisher);
				});
			});
		}
	});

	if ($('.panel-chat[data-code]').length) {
		if ($('.panel-chat[autocall]').length) {
			$('<div class="center-block" style="width: 264px"><div id="publisherElement"></div></div>').insertBefore('.panel-chat .list-group');

			$.post('/chat/' + $('.panel-chat').data('code'), 'call=true', function(data) {
				var apiKey    = "16819511";

				var session = OT.initSession(apiKey, data.sessionId);

				session.on("streamCreated", function(event) {
					session.subscribe(event.stream);
				});

				session.connect(data.token, function(error) {
					var publisher = OT.initPublisher('publisherElement');
					session.publish(publisher);
				});
			});
		}

		var $content = $('.panel-chat[data-code] > .list-group');
		var ids = [];
		$content.children().each(function() {
			var id = $(this).data('id');
			if (typeof id != 'undefined')
				ids.push(id);
		});
		console.log(ids);
		/*$.ajax({
			type: "DELETE",
			url: '/alerts/' + ids
		});*/
	}

	$('abbr.timeago').timeago();

	$('#message-chat').on('keyup', function(e) {
		if (e.which == 13 && ! e.shiftKey) {
			$(this.form).submit();
		}
	});

});

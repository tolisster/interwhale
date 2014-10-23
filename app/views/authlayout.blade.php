<!DOCTYPE html>
<html lang="en" data-user="{{ Auth::user()->code }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title') - International Dating Service</title>
	<!-- Bootstrap -->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,600,700&subset=latin,cyrillic">
	<!--<link rel="stylesheet" href="//cdn.jsdelivr.net/jquery.slick/1.3.7/slick.css">-->
	<link rel="stylesheet" href="/css/layout.css">
	@yield('css')
	<link rel="shortcut icon" href="http://www.interwhale.com/favicon.ico">
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ URL::route('profile') }}" title="InterWhale - International Dating Service"><img src="{{ asset('images/logo.png') }}" width="152" height="40" alt="InterWhale - International Dating Service"></a>
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse">
			@if (App::environment('local'))
			<form class="navbar-form navbar-left" role="search">
				<div class="input-group">
					<input type="search" class="form-control" placeholder="Search">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button"></button>
					</span>
				</div><!-- /input-group -->
			</form>
			@endif
			<ul class="nav navbar-nav navbar-right">
				<li><a href="{{ URL::route('search') }}">Search</a></li>
				<li data-item="messages">
					<a href="#" data-toggle="popover">Messages <span class="badge">{{ Auth::user()->messages()->where('sender_id', '<>', Auth::user()->id)->count() ?: '' }}</span></a>
					<div class="content-popover hide">
						@foreach (Auth::user()->messages()->where('sender_id', '<>', Auth::user()->id)->get() as $message)
						<?php $sender = User::find($message->sender_id); ?>
						@include('messages.alert')
						@endforeach
					</div>
				</li>
				<li data-item="alerts">
					<a href="#" data-toggle="popover">Alerts <span class="badge">{{ Auth::user()->alerts()->count() ?: '' }}</span></a>
					<div class="content-popover hide">
						@foreach (Auth::user()->alerts as $alert)
							@if ($alert->alertable instanceof User)
								<?php $user = $alert->alertable; ?>
								@include('user.line.friend')
							@endif
						@endforeach
					</div>
				</li>
				<li data-item="friends">
					<a href="{{ URL::route('friends.index') }}" data-toggle="popover">Friends <span class="badge">{{ Auth::user()->friendships()->wherePivot('state', 'pending')->count() ?: '' }}</span></a>
					<div class="content-popover hide">
						@foreach (Auth::user()->friendships()->wherePivot('state', 'pending')->with(array('country', 'avatar'))->get() as $user)
						@include('user.line.friendship')
						@endforeach
					</div>
				</li>
				@if (App::environment('local'))
				<li><a href="/static.html">Photos</a></li>
				@endif
				<li>
					<a href="{{ URL::route('profile') }}" class="avatar">
						@if (is_null(Auth::user()->avatar_id))
						<img src="{{ asset('images/noavatar32.png') }}" class="img-circle">
						@else
						<img src="{{ Auth::user()->avatar->url('avatar32') }}" alt="{{{ Auth::user()->full_name }}}" class="img-circle">
						@endif
						<b class="user-name">{{{ Auth::user()->full_name }}}</b>
					</a>
				</li>
				<li><a href="{{ URL::route('logout') }}" id="sign-out" title="Sign out"><span class="sr-only">Sign out</span></a></li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>

@yield('content')

<div class="modal fade">
	<div class="modal-dialog" style="width: 400px">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Reject</button>
				<a class="btn btn-primary" role="button">Accept</a>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//js.pusher.com/2.2/pusher.min.js"></script>

@yield('js')
<script src="/js/script.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
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
			<a class="navbar-brand" href="{{ URL::route('profile') }}" title="InterWhale - International Dating Service"><img src="{{ asset('images/logo.png') }}" width="156" height="40" alt="InterWhale - International Dating Service"></a>
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse">
			<form class="navbar-form navbar-left" role="search">
				<div class="input-group">
					<input type="search" class="form-control" placeholder="Search">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button"></button>
					</span>
				</div><!-- /input-group -->
			</form>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="/static.html">Messages<!-- <span class="badge">26</span>--></a></li>
				<li><a href="/static.html">Alerts</a></li>
				<li><a href="/static.html">Friends<!-- <span class="badge">4</span>--></a></li>
				<li><a href="/static.html">Photos</a></li>
				<li class="dropdown">
					<a href="" class="dropdown-toggle" data-toggle="dropdown">
						<img src="{{ asset('images/den-stafford-avatar-small.jpg') }}" alt="{{{ Auth::user()->full_name }}}" class="img-circle">
						<b class="user-name">{{{ Auth::user()->full_name }}}</b>
					</a>
					<ul class="dropdown-menu">
						<li><a href="{{ URL::route('profile.edit') }}">Edit</a></li>
						<li><a href="{{ URL::route('logout') }}">Disconnect</a></li>
					</ul>
				</li>
				<li><a href="{{ URL::route('logout') }}" id="sign-out" title="Sign out"><span class="sr-only">Sign out</span></a></li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>

@yield('content')
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
@yield('js')
<script src="/js/script.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>InterWhale - International Dating Service</title>
	<!-- Bootstrap -->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,600,700&subset=latin,cyrillic">
	<link rel="stylesheet" href="/css/home.css">
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
			<a class="navbar-brand" href="{{ URL::action('HomeController@getHome') }}" title="InterWhale - International Dating Service"><img src="{{ asset('images/logo.png') }}" width="152" height="40" alt="InterWhale - International Dating Service"></a>
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li>{{ link_to_action('HomeController@getPage', 'About', array('about')) }}</li>
				@if (App::environment('local'))
				<li>{{ link_to_action('HomeController@getPage', 'Contacts', array('contacts')) }}</li>
				<li>{{ link_to_action('HomeController@getPage', 'Terms', array('terms')) }}</li>
				<li>{{ link_to_action('HomeController@getPage', 'Help', array('help')) }}</li>
				@endif
			</ul>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>

@yield('content')
<footer>
	<div class="container">
		<p><img src="/images/copyright-symbol-home.png" alt="©" width="14" height="14"> 2014 InterWhale Group</p>
	</div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="/js/home.js"></script>
@if (App::environment('production') && $_SERVER['HTTP_HOST'] != 'testinterwhale-tolisster.rhcloud.com')
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-54150981-1', 'auto');
	ga('send', 'pageview');

</script>
@endif
</body>
</html>

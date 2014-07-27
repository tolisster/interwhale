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
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="/css/animate.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="/css/home.css">
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
			<a class="navbar-brand" href="/home.html"><img src="/images/logo.png" width="181" height="45" alt="InterWhale"/></a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="/static.html">About Us</a></li>
				<li><a href="/static.html">Contacts</a></li>
				<li><a href="/static.html">Terms</a></li>
				<li><a href="/static.html">Help</a></li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>
<div id="map">
	<div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<h1>Find friends <small>around the world</small></h1>
			<h1>Find friends <small>and acquaintances for travel</small></h1>
		</div>
		<div class="col-md-4">
			<div class="row" id="main-buttons">
				<div class="col-md-6">
					<button type="button" class="btn btn-link">Login</button>
				</div>
				<div class="col-md-6">
					<button type="button" class="btn btn-link">Register</button>
				</div>
			</div>
			<div id="signin-block" class="row">
				<form id="signin-form" role="form">
					<div class="form-group">
						<label for="email-input" class="sr-only">Enter your email address:</label>
						<input type="email" class="form-control" id="email-input" placeholder="email address" required autofocus>
					</div>
					<div class="form-group">
						<label for="password-input" class="sr-only">Enter your password:</label>
						<input type="password" class="form-control" id="password-input" placeholder="password" required>
					</div>
					<div class="form-group text-center">
						<button type="submit" class="btn btn-primary">Login</button>
					</div>
				</form>
				<div class="row text-center">
					<a href="/forgot-password.html">Forgot your password?</a>
				</div>
			</div>
			<!--<ul class="nav nav-tabs row" role="tablist">
				<li class="col-md-6"><a href="#signin" role="tab" data-toggle="tab">Login</a></li>
				<li class="col-md-6"><a href="#register" role="tab" data-toggle="tab">Register</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane" id="signin">
					<form id="signin-form" role="form">
						<div class="form-group">
							<label for="email-input" class="sr-only">Enter your email address:</label>
							<input type="email" class="form-control" id="email-input" placeholder="email address" required autofocus>
						</div>
						<div class="form-group">
							<label for="password-input" class="sr-only">Enter your password:</label>
							<input type="password" class="form-control" id="password-input" placeholder="password" required>
						</div>
						<div class="form-group text-center">
							<button type="submit" class="btn btn-primary">Login</button>
						</div>
					</form>
					<div class="row text-center">
						<a href="/forgot-password.html">Forgot your password?</a>
					</div>
				</div>
				<div class="tab-pane" id="register">...</div>
			</div>-->
		</div>
		<div class="col-md-4">
		</div>
	</div>
</div>
<div id="apps-block">
	<button type="button"><div><img src="/images/apple-logo.png" width="27" height="32" alt="App Store"/></div> <h4><small>Available on the</small> App Store</h4></button><!-- href="https://itunes.apple.com/genre/id36" rel="nofollow"-->
	<button type="button"><div><img src="/images/android-logo.png" width="27" height="32" alt="Google Play"/></div> <h4><small>Available on the</small> Google Play</h4></button><!-- href="https://play.google.com/store" rel="nofollow"-->
	<button type="button"><div><img src="/images/windows-logo.png" width="27" height="32" alt="Windows Phone Store"/></div> <h4><small>Available on the</small> Windows Phone Store</h4></button><!-- href="http://www.windowsphone.com/en-US/store" rel="nofollow"-->
</div>
<footer>
	<div class="container">
		<p class="text-right"><img src="/images/copyright-symbol.png" alt="©" width="19" height="19"> 2014 InterWhale Group</p>
	</div>
</footer>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script src="/js/lettering.js"></script>
<script src="/js/textillate.js"></script>
<script src="/js/home.js"></script>
</body>
</html>

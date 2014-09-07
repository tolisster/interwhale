<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $user->name }} - International Dating Service</title>
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
	<link rel="stylesheet" href="/css/user.css">
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
			<a class="navbar-brand" href="/home.html" title="InterWhale - International Dating Service"><img src="/images/logo.png" width="156" height="40" alt="InterWhale - International Dating Service"></a>
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
				<li><a href="/static.html">Messages <span class="badge">26</span></a></li>
				<li><a href="/static.html">Alerts</a></li>
				<li><a href="/static.html">Friends <span class="badge">4</span></a></li>
				<li><a href="/static.html">Photos</a></li>
				<li class="dropdown">
					<a href="" class="dropdown-toggle" data-toggle="dropdown">
						<img src="/images/den-stafford-avatar-small.jpg" width="32" height="32" alt="{{ $user->name }}" class="img-circle">
						<b class="user-name">{{ $user->name }}</b>
					</a>
					<ul class="dropdown-menu">
						<li><a href="">Disconnect</a></li>
					</ul>
				</li>
				<li><a href="/static.html" id="sign-out" title="Sign out"><span class="sr-only">Sign out</span></a></li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>
<div class="container">
	<div class="row equal">
		<div class="col-md-3" id="sidebar">
			<div class="border-right"></div>
			<div id="avatar">
				<img src="/images/den-stafford-avatar.jpg" width="108" height="108" alt="{{ $user->name }}" class="img-circle center-block">
			</div>
			<div id="avatar-background" style="background-image:url(/images/den-stafford-background.jpg);background-position:50% 93%">
				<div>
					<p>Ищу попутчика для путешествия по Индии этим летом.</p>
				</div>
			</div>
			<div id="online" class="pull-left">Online</div>
			<div id="time" class="pull-right">9:53 pm</div>
			<h1>{{ $user->name }} <small>Los Angeles, California</small></h1>
			<ul class="nav nav-pills nav-stacked" id="user-menu">
				<li class="active"><a href="#">Settings</a></li>
				<li><a href="#">Statistics</a></li>
			</ul>
			<ul class="nav nav-pills" id="user-links">
				<li><a href="#" title="Dribbble" style="background-image:url(/images/dribbble-connect.png)"></a></li>
				<li class="active"><a href="#" title="Vimeo" style="background-image:url(/images/vimeo-connect.png)"></a></li>
				<li><a href="#" title="Facebook" style="background-image:url(/images/facebook-connect.png)"></a></li>
			</ul>
			<footer>
				<p><img src="/images/copyright-symbol.png" alt="©" width="14" height="14"> 2014 InterWhale Group</p>
			</footer>
		</div>
		<div class="col-md-9" id="main-content">
			<div class="row">
				<div class="col-md-7">
					<div class="panel">
						<div class="panel-heading">
							Information
							<span class="editable"></span>
							<a class="btn" href="#" role="button">Edit</a>
						</div>
						<table class="table">
							<tr>
								<th>Пол:</th>
								<td>мужской</td>
							</tr>
							<tr>
								<th>Возраст:</th>
								<td>24</td>
							</tr>
							<tr>
								<th>Семейное положение:</th>
								<td>женат</td>
							</tr>
							<tr>
								<th>Язык:</th>
								<td>английский</td>
							</tr>
							<tr>
								<th>Родной город:</th>
								<td>Лос-Анджелес</td>
							</tr>
							<tr>
								<th>Образование:</th>
								<td>МГУ</td>
							</tr>
							<tr>
								<th>Деятельность:</th>
								<td>журналист</td>
							</tr>
							<tr>
								<th>Религия:</th>
								<td>католицизм</td>
							</tr>
							<tr>
								<th>Интересы:</th>
								<td>спорт, путешествие</td>
							</tr>
							<tr>
								<th>Хобби:</th>
								<td>стрит арт</td>
							</tr>
							<tr>
								<th>Мечта:</th>
								<td>полететь в космос</td>
							</tr>
						</table>
					</div>
					<div class="panel">
						<div class="panel-heading">
							About Me
							<span class="editable"></span>
							<a class="btn" href="#" role="button">Edit</a>
						</div>
						<div class="panel-body">
							<p>Душа моя озарена неземной радостью, как эти чудесные весенние утра, которыми я наслаждаюсь от всего сердца. Я совсем один и блаженствую в здешнем краю, словно созданном для таких, как я. Я так счастлив, мой друг, так упоен ощущением покоя, что искусство мое страдает от этого.</p>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="panel user-photos">
						<div class="panel-heading">
							Photos
							<span class="editable"></span>
							<a class="btn" href="#" role="button">Edit</a>
						</div>
						<div class="border-top"></div>
						<div class="row">
							<div class="col-md-8">
								<a href="#" class="thumbnail">
									<img src="/images/photo200x200_1.jpg" width="200" height="200" alt="Photo description">
									<span></span>
								</a>
							</div>
							<div class="col-md-4">
								<a href="#" class="thumbnail">
									<img src="/images/photo100x100_1.jpg" width="100" height="100" alt="Photo description">
									<span></span>
								</a>
								<a href="#" class="thumbnail">
									<img src="/images/photo100x100_2.jpg" width="100" height="100" alt="Photo description">
									<span></span>
								</a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<a href="#" class="thumbnail">
									<img src="/images/photo100x100_3.jpg" width="100" height="100" alt="Photo description">
									<span></span>
								</a>
								<a href="#" class="thumbnail">
									<img src="/images/photo100x100_4.jpg" width="100" height="100" alt="Photo description">
									<span></span>
								</a>
							</div>
							<div class="col-md-8">
								<a href="#" class="thumbnail">
									<img src="/images/photo200x200_2.jpg" width="200" height="200" alt="Photo description">
									<span></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel user-map">
				<div class="panel-heading">
					Find friends on the map
				</div>
				<div class="border-top"></div>
				<form class="form-inline" role="form">
					<div class="form-group">
						<label class="sr-only" for="search-map-input">Search</label>
						<input type="search" class="form-control" id="search-map-input" placeholder="Search">
					</div>
				</form>
				<div id="map-container"></div>
			</div>
			<div class="panel random-users">
				<div class="panel-heading">
					They want to find a friend in your country
				</div>
				<div class="border-top"></div>
				<div class="panel-body">
					<ul class="nav nav-pills">
						<li class="active">
							<a href="#">
								<img src="/images/chris-bale-avatar-middle.jpg" width="45" height="45" alt="Chris Bale" class="img-circle">
								<b>Chris Bale <small>Brazil</small></b>
							</a>
						</li>
						<li>
							<a href="#">
								<img src="/images/diana-beasley-avatar-middle.jpg" width="45" height="45" alt="Chris Bale" class="img-circle">
								<b>Diana Beasley <small>Canada</small></b>
							</a>
						</li>
						<li>
							<a href="#">
								<img src="/images/dina-henkel-avatar-middle.jpg" width="45" height="45" alt="Chris Bale" class="img-circle">
								<b>Dina Henkel <small>Germany</small></b>
							</a>
						</li>
						<li>
							<a href="#">
								<img src="/images/martin-green-avatar-middle.jpg" width="45" height="45" alt="Chris Bale" class="img-circle">
								<b>Martin Green <small>England</small></b>
							</a>
						</li>
						<!--<li>
							<a href="#">
								<img src="/images/wavy-hairstyle-avatar-middle.jpg" width="45" height="45" alt="Chris Bale" class="img-circle">
								<b>Wavy Hairstyle <small>Germany</small></b>
							</a>
						</li>-->
					</ul>
				</div>
			</div>
			<footer>
				<div class="row">
					<div class="col-md-4">
						<ul class="nav nav-pills nav-apps">
							<li class="active"><a href="https://play.google.com/store" rel="nofollow" style="background-image:url(/images/android-logo.png)" title="Available on the Google Play"><b class="sr-only"><small>Available on the</small> Google Play</b></a></li>
							<li><a href="https://itunes.apple.com/genre/id36" rel="nofollow" style="background-image:url(/images/apple-logo.png)" title="Available on the App Store"><b class="sr-only"><small>Available on the</small> App Store</b></a></li>
							<li><a href="http://www.windowsphone.com/en-US/store" rel="nofollow" style="background-image:url(/images/windows-logo.png)" title="Available on the Windows Phone Store"><b class="sr-only"><small>Available on the</small> Windows Phone Store</b></a></li>
						</ul>
					</div>
					<div class="col-md-3">
						<div class="dropup dropdown-language">
							<button class="btn btn-link dropdown-toggle" type="button" id="languageDropdownMenu" data-toggle="dropdown">
								Select language
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="languageDropdownMenu">
								<li role="presentation" class="active"><a role="menuitem" tabindex="-1" href="#">English</a></li>
								<li role="presentation"><a role="menuitem" tabindex="-1" href="#" lang="ar">العربية</a></li>
								<li role="presentation"><a role="menuitem" tabindex="-1" href="#" lang="ru">Русский</a></li>
								<li role="presentation"><a role="menuitem" tabindex="-1" href="#" lang="it">Italiano</a></li>
								<li role="presentation"><a role="menuitem" tabindex="-1" href="#" lang="es">Español</a></li>
								<li role="presentation"><a role="menuitem" tabindex="-1" href="#" lang="de">Deutsch</a></li>
								<li role="presentation"><a role="menuitem" tabindex="-1" href="#" lang="fr">Français</a></li>
								<li role="presentation"><a role="menuitem" tabindex="-1" href="#" lang="tr">Türkçe</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-5">
						<ul class="nav nav-pills nav-main">
							<li><a href="/static.html">About Us</a></li>
							<li><a href="/static.html">Contacts</a></li>
							<li><a href="/static.html">Terms</a></li>
							<li><a href="/static.html">Help</a></li>
						</ul>
					</div>
				</div>
			</footer>
		</div>
	</div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<!--<script src="//cdn.jsdelivr.net/jquery.slick/1.3.7/slick.min.js"></script>-->
<script src="/js/script.js"></script>
</body>
</html>

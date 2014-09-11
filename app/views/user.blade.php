@extends('guestlayout')

@section('content')
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
@stop
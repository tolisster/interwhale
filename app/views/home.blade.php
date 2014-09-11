@extends('guestlayout')

@section('content')
<div id="map">
	<div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div id="run-text-block" class="hidden-xs hidden-sm">
				<h1>Find friends <small>around the world</small></h1>
				<h1>Find friends <small>and acquaintances for travel</small></h1>
				<h1><small>Payment per year</small> is just $2.99</h1>
			</div>
		</div>
		<div class="col-md-4">
			<ul class="nav nav-pills nav-justified" role="tablist">
				<li class="active"><a href="#log-in" role="tab" data-toggle="pill">Log in</a></li>
				<li><a href="#sign-up" role="tab" data-toggle="pill">Sign up</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="log-in">
					<form role="form" method="post" action="{{ URL::to('login') }}">
						<h2>Log in to your account</h2>
						<div class="btn-group btn-group-justified" id="sign-in-with">
							<div class="btn-group">
								<button type="button" class="btn btn-default"><span>Sign in with</span> <span><img src="/images/facebook.png" width="8" height="18" alt="Facebook"></span></button>
							</div>
							<div class="btn-group">
								<button type="button" class="btn btn-default"><span>Sign in with</span> <span><img src="/images/google-accounts.png" width="17" height="18" alt="Google Accounts"></span></button>
							</div>
						</div>
						<div class="form-group">
							<label for="email-input" class="sr-only">Email address</label>
							<input type="email" name="email" class="form-control" id="email-input" placeholder="Email address" required autofocus>
						</div>
						<div class="form-group">
							<label for="password-input" class="sr-only">Password</label>
							<input type="password" name="password" class="form-control" id="password-input" placeholder="Password" required>
						</div>
						<div class="checkbox text-center">
							<label>
								<input type="checkbox" name="remember"> Remember your password
							</label>
						</div>
						<div class="form-group text-center">
							<button type="submit" class="btn btn-primary">Log in</button>
						</div>
					</form>
				</div>
				<div class="tab-pane" id="sign-up">
					<form role="form" method="post" action="{{ URL::to('register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<h2>Create new account</h2>
						<div class="form-group">
							<label for="name-input" class="sr-only">Name</label>
							<input type="text" name="name" class="form-control" id="name-input" placeholder="Name" required>
						</div>
						<div class="form-group">
							<label for="email-input" class="sr-only">Email address</label>
							<input type="email" name="email" class="form-control" id="email-input" placeholder="Email address" required>
						</div>
						<div class="form-group">
							<label for="password-input" class="sr-only">Password</label>
							<input type="password" name="password" class="form-control" id="password-input" placeholder="Password" required>
						</div>
						<div class="form-group text-center">
							<button type="submit" class="btn btn-primary">Sign up</button>
						</div>
					</form>
				</div>
			</div>
			<div class="row text-center">
				<a href="{{ action('RemindersController@getRemind') }}">Forgot your password?</a>
			</div>
			<ul class="list-group hidden-xs hidden-sm" id="last-connections">
				<li class="list-group-item"><strong><img src="http://www.logicsoft.md/images/famfamfam/flag_icons/it.png" width="16" height="11" alt="Italia" lang="it"> Laura Moretti</strong> meet with <strong>Mikhail Galushko <img src="http://www.logicsoft.md/images/famfamfam/flag_icons/ua.png" width="16" height="11" alt="Україна" lang="ua"></strong></li>
				<li class="list-group-item"><strong><img src="http://www.logicsoft.md/images/famfamfam/flag_icons/us.png" width="16" height="11" alt="United States of America" lang="en"> Craig Manson</strong> meet with <strong>Anna Lee <img src="http://www.logicsoft.md/images/famfamfam/flag_icons/hk.png" width="16" height="11" alt="香港特別行政區" lang="cn"></strong></li>
				<li class="list-group-item"><strong><img src="http://www.logicsoft.md/images/famfamfam/flag_icons/pt.png" width="16" height="11" alt="República Portuguesa" lang="pt"> Christian Bento</strong> meet with <strong>Brian Cors <img src="http://www.logicsoft.md/images/famfamfam/flag_icons/england.png" width="16" height="11" alt="England" lang="en"></strong></li>
			</ul>
			<div id="count-users" class="hidden-xs hidden-sm">
				<h3 class="text-center">1,012,568 <small>all users</small></h3>
			</div>
		</div>
		<div class="col-md-4">
			<div class="pull-right">
				<div class="dropdown hidden-xs hidden-sm">
					<button class="btn btn-link dropdown-toggle" type="button" id="languageDropdownMenu" data-toggle="dropdown">
						<span class="caret"></span>
						Select language
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
		</div>
	</div>
</div>
<div id="apps-block" class="hidden-xs hidden-sm">
	<button type="button"><div><img src="/images/apple-logo.png" width="18" height="21" alt="App Store"/></div> <h4><small>Available on the</small> App Store</h4></button><!-- href="https://itunes.apple.com/genre/id36" rel="nofollow"-->
	<button type="button"><div><img src="/images/android-logo.png" width="18" height="21" alt="Google Play"/></div> <h4><small>Available on the</small> Google Play</h4></button><!-- href="https://play.google.com/store" rel="nofollow"-->
	<button type="button"><div><img src="/images/windows-logo.png" width="20" height="20" alt="Windows Phone Store"/></div> <h4><small>Available on the</small> Windows Phone Store</h4></button><!-- href="http://www.windowsphone.com/en-US/store" rel="nofollow"-->
</div>
@stop
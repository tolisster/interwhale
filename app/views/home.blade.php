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
				<li class="active"><a href="#login" role="tab" data-toggle="pill">Log in</a></li>
				<li><a href="#register" role="tab" data-toggle="pill">Sign up</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="login">
					{{ Form::open(array('url' => 'login', 'method' => 'post', 'role' => 'form')) }}
						<h2>Log in to your account</h2>
						@if (App::environment('local'))
						<div class="btn-group btn-group-justified" id="sign-in-with">
							<div class="btn-group">
								<button type="button" class="btn btn-default"><span>Sign in with</span> <span><img src="/images/facebook.png" width="8" height="18" alt="Facebook"></span></button>
							</div>
							<div class="btn-group">
								<button type="button" class="btn btn-default"><span>Sign in with</span> <span><img src="/images/google-accounts.png" width="17" height="18" alt="Google Accounts"></span></button>
							</div>
						</div>
						@endif
						<div class="form-group">
							{{ Form::label('email-login', 'Email address', array('class' => 'sr-only')) }}
							{{ Form::email('email', Input::old('email'), array('id' => 'email-login', 'class' => 'form-control', 'placeholder' => 'Email address', 'required' => 'required', 'autofocus' => 'autofocus')) }}
						</div>
						<div class="form-group">
							{{ Form::label('password-login', 'Password', array('class' => 'sr-only')) }}
							{{ Form::password('password', array('id' => 'password-login', 'class' => 'form-control', 'placeholder' => 'Password', 'required' => 'required')) }}
						</div>
						@if ($error = $errors->first('password'))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
						<div class="checkbox text-center">
							<label>
								{{ Form::checkbox('remember', '1') }} Remember your password
							</label>
						</div>
						<div class="form-group text-center">
							{{ Form::button('Log in', array('type' => 'submit', 'class' => 'btn btn-primary')) }}
						</div>
					{{ Form::close() }}
				</div>
				<div class="tab-pane" id="register">
					{{ Form::open(array('url' => 'register', 'method' => 'post', 'role' => 'form')) }}
						@if (App::environment('local'))
						<h2>Create new account</h2>
					{{-- <div class="form-group">
							{{ Form::label('first-name-register', 'First name', array('class' => 'sr-only')) }}
							{{ Form::text('first_name', null, array('id' => 'first-name-register', 'class' => 'form-control', 'placeholder' => 'First name', 'required' => 'required')) }}
						</div>
						<div class="form-group">
							{{ Form::label('last-name-register', 'Last name', array('class' => 'sr-only')) }}
							{{ Form::text('last_name', null, array('id' => 'last-name-register', 'class' => 'form-control', 'placeholder' => 'Last name', 'required' => 'required')) }}
						</div>
						<div class="form-group">
							{{ Form::label('email-register', 'Email address', array('class' => 'sr-only')) }}
							{{ Form::email('email', null, array('id' => 'email-register', 'class' => 'form-control', 'placeholder' => 'Email address', 'required' => 'required')) }}
						</div>
						<div class="form-group">
							{{ Form::label('password-register', 'Password', array('class' => 'sr-only')) }}
							{{ Form::password('password', array('id' => 'password-register', 'class' => 'form-control', 'placeholder' => 'Password', 'required' => 'required')) }}
						</div>
						<div class="form-group">
							{{ Form::label('password-confirmation-register', 'Password confirmation', array('class' => 'sr-only')) }}
							{{ Form::password('password_confirmation', array('id' => 'password-confirmation-register', 'class' => 'form-control', 'placeholder' => 'Password confirmation', 'required' => 'required')) }}
						</div> --}}
						<div class="form-group">
							{{ Form::label(null, 'Payment method', array('class' => 'sr-only')) }}
							<select class="form-control">
								<option value="skrill">Will be processed by Skrill</option>
								@if (App::environment('local'))
								<option value="paypal">Will be processed by PayPal</option>
								@endif
							</select>
						</div>
						<p class="text-center">Payment per year 2.99 USD</p>
						<div class="form-group text-center">
							{{ Form::button('Sign up', array('type' => 'submit', 'class' => 'btn btn-primary', 'data-loading-text' => 'Processing...')) }}
						</div>
						@else
						<p class="text-center">Currently registration is not possible. Please try later.</p>
						@endif
					{{ Form::close() }}
				</div>
			</div>
			<div class="row text-center">
				{{ link_to_action('RemindersController@getRemind', 'Forgot your password?') }}
			</div>
			@if (App::environment('local'))
			<ul class="list-group hidden-xs hidden-sm" id="last-connections">
				<li class="list-group-item"><strong><img src="http://www.logicsoft.md/images/famfamfam/flag_icons/it.png" width="16" height="11" alt="Italia" lang="it"> Laura Moretti</strong> meet with <strong>Mikhail Galushko <img src="http://www.logicsoft.md/images/famfamfam/flag_icons/ua.png" width="16" height="11" alt="Україна" lang="ua"></strong></li>
				<li class="list-group-item"><strong><img src="http://www.logicsoft.md/images/famfamfam/flag_icons/us.png" width="16" height="11" alt="United States of America" lang="en"> Craig Manson</strong> meet with <strong>Anna Lee <img src="http://www.logicsoft.md/images/famfamfam/flag_icons/hk.png" width="16" height="11" alt="香港特別行政區" lang="cn"></strong></li>
				<li class="list-group-item"><strong><img src="http://www.logicsoft.md/images/famfamfam/flag_icons/pt.png" width="16" height="11" alt="República Portuguesa" lang="pt"> Christian Bento</strong> meet with <strong>Brian Cors <img src="http://www.logicsoft.md/images/famfamfam/flag_icons/england.png" width="16" height="11" alt="England" lang="en"></strong></li>
			</ul>
			<div id="count-users" class="hidden-xs hidden-sm">
				<h3 class="text-center">1,012,568 <small>all users</small></h3>
			</div>
			@endif
		</div>
		<div class="col-md-4">
			<div class="pull-right">
				<div class="dropdown hidden-xs hidden-sm">
					<button class="btn btn-link dropdown-toggle" type="button" id="languageDropdownMenu" data-toggle="dropdown">
						<span class="caret"></span>
						Select language
					</button>
					<ul class="dropdown-menu" role="menu" aria-labelledby="languageDropdownMenu">
						@if ('en' == App::getLocale())
						<li role="presentation" class="active"><a role="menuitem" tabindex="-1" href="{{ URL::action('HomeController@getHome') }}">English</a></li>
						@else
						<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::action('HomeController@getHome') }}" lang="en">English</a></li>
						@endif
						@foreach (Config::get('app.supported_locales') as $locale)
						@if ($locale == App::getLocale())
						<li role="presentation" class="active"><a role="menuitem" tabindex="-1" href="/{{ $locale }}">{{ $locale }}</a></li>
						@else
						<li role="presentation"><a role="menuitem" tabindex="-1" href="/{{ $locale }}" lang="{{ $locale }}">{{ $locale }}</a></li>
						@endif
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@if (App::environment('local'))
<div id="apps-block" class="hidden-xs hidden-sm">
	<button type="button"><div><img src="/images/apple-logo.png" width="18" height="21" alt="App Store"/></div> <h4><small>Available on the</small> App Store</h4></button><!-- href="https://itunes.apple.com/genre/id36" rel="nofollow"-->
	<button type="button"><div><img src="/images/android-logo.png" width="18" height="21" alt="Google Play"/></div> <h4><small>Available on the</small> Google Play</h4></button><!-- href="https://play.google.com/store" rel="nofollow"-->
	<button type="button"><div><img src="/images/windows-logo.png" width="20" height="20" alt="Windows Phone Store"/></div> <h4><small>Available on the</small> Windows Phone Store</h4></button><!-- href="http://www.windowsphone.com/en-US/store" rel="nofollow"-->
</div>
@endif
@stop
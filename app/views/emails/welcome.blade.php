<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
</head>
<body>
<h2>Welcome, {{{ $user->full_name }}}!</h2>

<div>
	Your temporary password: {{ $password }}<br>
	You can change in settings on your profile page.
</div>
</body>
</html>
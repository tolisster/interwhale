<table class="table">
	<tr>
		<th>Gender</th>
		<td>{{ $user->user_info->gender_name }}</td>
	</tr>
	@if ($user->user_info->show_age)
	<tr>
		<th>Age</th>
		<td>{{ $user->user_info->age }}</td>
	</tr>
	@endif
	<tr>
		<th>Relationship Status</th>
		<td>{{ $user->user_info->relationship_name }}</td>
	</tr>
	<tr>
		<th>Languages</th>
		<td>{{ $user->user_info->language_names }}</td>
	</tr>
	<tr>
		<th>Hometown</th>
		<td>{{{ $user->city }}}</td>
	</tr>
	<tr>
		<th>Education</th>
		<td>{{{ $user->user_info->education }}}</td>
	</tr>
	<tr>
		<th>Activity</th>
		<td>{{{ $user->user_info->activity }}}</td>
	</tr>
	<tr>
		<th>Religion</th>
		<td>{{ $user->user_info->religion_name }}</td>
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

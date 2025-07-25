<table class="table table-bordered">
	<tr>
		<td colspan="2" class="text-center"><img class="thumb-image-md"
				src="{{ profile_picture($user->profile_picture) }}"></td>
	</tr>
	<tr><td>{{ _lang('First Name') }}</td><td>{{ $user->first_name }}</td></tr>
	<tr><td>{{ _lang('Middle Name') }}</td><td>{{ $user->middle_name }}</td></tr>
	<tr><td>{{ _lang('Last Name') }}</td><td>{{ $user->last_name }}</td></tr>
	<tr><td>{{ _lang('Email') }}</td><td>{{ $user->email }}</td></tr>
	<tr><td>{{ _lang('User Type') }}</td><td>{{ $user->user_type }}</td></tr>
	<tr><td>{{ _lang('Locations') }}</td><td>
	    @foreach($locations as $location)
		{{ $location->name }},
		@endforeach
	</td></tr>
	<tr><td>{{ _lang('User Role') }}</td><td>{{ $user->role->name }}</td></tr>
	<tr><td>{{ _lang('Status') }}</td><td>{!! xss_clean(status($user->status)) !!}</td></tr>
	<tr><td>{{ _lang('Created At') }}</td><td>{{ $user->created_at }}</td></tr>
</table>


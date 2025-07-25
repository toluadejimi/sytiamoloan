<form method="post" class="ajax-screen-submit" autocomplete="off" id="taxesModal" action="{{ action('SystemUserController@update', $id) }}" enctype="multipart/form-data">
	{{ csrf_field()}}
	<input name="_method" type="hidden" value="PATCH">

	<div class="row p-2">
		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">{{ _lang('First Name') }}</label>
				<input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" required>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">{{ _lang('Middle Name') }}</label>
				<input type="text" class="form-control" name="middle_name" value="{{ $user->middle_name }}" >
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">{{ _lang('Last Name') }}</label>
				<input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" required>
			</div>
		</div>
		
        <div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Phone') }}</label>
				<input type="text" class="form-control" name="phone" value="{{ $user->phone }}" required>
			</div>
		</div>
		
		<div class="col-md-6">
			<div class="form-group">
			   <label class="control-label">{{ _lang('Email') }}</label>
			   <input type="text" class="form-control" name="email" value="{{ $user->email }}" required>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
			   <label class="control-label">{{ _lang('Password') }}</label>
			   <input type="password" class="form-control" name="password" value="">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('User Type') }}</label>
				<select class="form-control select2 auto-select" data-selected="{{ $user->user_type }}" name="user_type" id="user_type" required>
					<option value="{{ $user->user_type }}">{{ $user->user_type }}</option>
					<option value="admin">{{ _lang('Admin') }}</option>
					<option value="user">{{ _lang('User') }}</option>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('User Role') }}</label>
				<select class="form-control select2-ajax" data-href="{{ route('roles.create') }}"  data-title="{{ _lang('Add New Role') }}" data-value="id" data-display="name" data-table="roles" id="role_id" name="role_id">
					<option value="">{{ _lang('Select One') }}</option>
					{{ create_option("roles","id","name", $user->role_id) }}
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Status') }}</label>
				<select class="form-control select2 auto-select" data-selected="{{ $user->status }}" name="status" required>
					<option value="">{{ _lang('Select One') }}</option>
					<option value="1">{{ _lang('Active') }}</option>
					<option value="0">{{ _lang('In Active') }}</option>
				</select>
			</div>
		</div>
        <div class="col-md-6">
			<div class="form-group">
			   
			    @foreach($loc as $lo )
				    {{ $lo->name }},
				    @endforeach
				<label class="control-label">{{ _lang('Location') }}(Please Re-Select the Location before Updating)</label>
				<select class="form-control auto-select select2 mselect" data-selected="{{ old('branch_id') }}" name="branch_id[]" id="branch_id[]" multiple required>
				    
					@foreach($locations as $location )
					
						<option value="{{ $location->id  }}">{{ $location->name  }}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
			   <label class="control-label">{{ _lang('Profile Picture') }}</label>
			   <input type="file" class="form-control dropify" name="profile_picture">
			</div>
		</div>

		<!--<div class="form-group row">-->
		<!--	<label class="col-xl-3 col-form-label">{{ _lang('Api Token') }}</label>-->
		<!--	<div class="col-xl-9">-->
		<!--		<input type="text" class="form-control" name="api_token">-->
		<!--	</div>-->
		<!--</div>-->

		<div class="form-group">
			<div class="col-md-12">
				<button type="submit" id="btnSubmit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Update') }}</button>
			</div>
		</div>
	</div>
</form>
<script>
    $('#btnSubmit').on("click", function(event) {
    // submit form via ajax, then

    event.preventDefault();
    $('#taxesModal').modal( 'hide' );
});
</script>
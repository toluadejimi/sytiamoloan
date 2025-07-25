@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">{{ _lang('Create System User') }}</h4>
            </div>
            <div class="card-body">
                <form method="post" class="validate" autocomplete="off" action="{{ route('system_users.store') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('First Name') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>
                                </div>
                            </div>
                            
                            
       
                    <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Middle Name') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="middle_name" value="{{ old('middle_name') }}" required>
                                </div>
                            </div>
                            
                            
                       <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Last Name') }}</label>
                                <div class="col-xl-9">
                                    	<input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
                                </div>
                            </div>
                     

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Email') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="email" value="{{ old('email') }}"
                                        required>
                                </div>
                            </div>
                            
                             <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Phone') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>
                                </div>
                            </div>
                            
                            
                            
                            
                        <!--    <div class="form-group row">-->
                        <!--        <label class="col-xl-3 col-form-label">{{ _lang('Phone') }}</label>-->
                        <!--        	<label class="control-label">{{ _lang('Phone') }}</label>-->
				                    <!--<input type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>-->
                        <!--        </div>-->
                        <!--    </div>-->
                           


                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Password') }}</label>
                                <div class="col-xl-9">
                                    <input type="password" class="form-control" name="password" value="" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('User Type') }}</label>
                                <div class="col-xl-9">
                                    <select class="form-control auto-select" data-selected="{{ old('user_type') }}"
                                        name="user_type" id="user_type" required>
                                     	<option value="">{{ _lang('Select One') }}</option>
                    					<option value="admin">{{ _lang('Admin') }}</option>
                    					<option value="manager">{{ _lang('Regoinal Manager') }}</option>
                    					<option value="user">{{ _lang('User') }}</option>
                    					<option value="rmafo">{{ _lang('RM/AFO') }}</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('User Role') }}</label>
                                <div class="col-xl-9">
                                    <select class="form-control select2-ajax" data-href="{{ route('roles.create') }}" data-title="{{ _lang('Add New Role') }}" data-value="id" data-display="name"
                                        data-table="roles" id="role_id" name="role_id" disabled>
                                    </select>
                                </div>
                            </div>
                            
                            
                            
                            
                                <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Location') }}</label>
                                <div class="col-xl-9">
                                    <select class="form-control select2 auto-select" data-selected="{{ old('branch_id') }}" name="branch_id[]" multiple="" required>
					                @foreach(get_table('branches') as $loaction )
									<option value="{{ $loaction->id }}">{{ $loaction->name  }}</option>
									@endforeach
                                    </select>
                                </div>
                            </div>
                            
                            
                            
           

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Status') }}</label>
                                <div class="col-xl-9">
                                    <select class="form-control auto-select" data-selected="{{ old('status') }}"
                                        name="status" required>
                                        <option value="">{{ _lang('Select One') }}</option>
                                        <option value="1">{{ _lang('Active') }}</option>
                                        <option value="0">{{ _lang('In Active') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Profile Picture') }}</label>
                                <div class="col-xl-9">
                                    <input type="file" class="form-control dropify" name="profile_picture">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-xl-9 offset-xl-3">
                                    <button type="submit" class="btn btn-primary">{{ _lang('Create User') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
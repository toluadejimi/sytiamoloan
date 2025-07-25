@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-header d-flex align-items-center">
                <h4 class="header-title">{{ ucwords(str_replace("_"," ",$status)).' '._lang('Users') }}</h4>

                <div class="ml-auto">
                    <div class="dropdown d-inline-block">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="userFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ ucwords(str_replace("_"," ",$status)).' '._lang('Users') }}
                        </button>

                        <div class="dropdown-menu" aria-labelledby="userFilter">
                            <a class="dropdown-item" href="{{ route('users.index') }}">{{ _lang('All Users') }}</a>
                            <a class="dropdown-item" href="{{ route('users.filter') }}/email_verified">{{ _lang('Email Verified') }}</a>
                            <a class="dropdown-item" href="{{ route('users.filter') }}/email_unverified">{{ _lang('Email Unverified') }}</a>
                            <a class="dropdown-item" href="{{ route('users.filter') }}/sms_verified">{{ _lang('SMS Verified') }}</a>
                            <a class="dropdown-item" href="{{ route('users.filter') }}/sms_unverified">{{ _lang('SMS Unverified') }}</a>
                            <a class="dropdown-item" href="{{ route('users.filter') }}/inactive">{{ _lang('Inactive Users') }}</a>
                        </div>
                    </div>

                    <a class="btn btn-primary btn-sm ajax-modal" data-title="{{ _lang('CREATE NEW USER') }}"
                        href="{{ route('users.create') }}"><i class="icofont-plus-circle"></i> {{ _lang('Add New') }}</a>
                </div>
            </div>

            <div class="card-body">
                <table id="users_table" class="table table-bordered data-table" >
                    <thead>
                        <tr>
                            <th>Profile Image</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Location</th>
                            <th>Phone</th>
                            <th>Status</th>
                            
                            <th class="text-center">{{ _lang('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        
                @if(Auth::user()->user_type == 'manager')
                        @foreach($manager as $ma)
                            {!! $users->links() !!}
                           
                            <td><img src="{{ url('public/uploads/media/'.$ma->profile_picture)}}"  width="50px" height="50px"/></td>
                            <td>{{ $ma->first_name }}</td>
                            <td>{{ $ma->last_name }}</td>
                            <td>{{ $ma->branch->name}}</td>
                            <td>{{ $ma->phone }}</td>
							
							<td>
							    @if($ma->status != 1)
							        Not Active
							    @else
							        Active
							    @endif
							</td>
						
							

							<td class="text-center">
								<div class="dropdown">
									<button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Action
									</button>
									<form action="{{ route('users.destroy', $ma['id']) }}" method="post">
									{{ csrf_field() }}
									<input name="_method" type="hidden" value="DELETE">

									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a href="{{ route('users.edit', $ma['id']) }}" class="dropdown-item dropdown-edit dropdown-edit"><i class="icofont-ui-edit"></i> Edit</a>
										<a href="{{ route('users.show', $ma['id']) }}" class="dropdown-item dropdown-edit dropdown-edit"><i class="bi bi-eye-fill"></i> View</a>
										<!--<button class="btn-remove dropdown-item" type="submit"><i class="icofont-trash"></i> Delete</button>-->
									</div>
									</form>
								</div>
							</td>
						</tr>
					@endforeach
					
                @else
                
                @foreach($users as $user)
                
                           
                            <td><img src="{{ url('public/uploads/media/'.$user->profile_picture)}}"  width="50px" height="50px"/></td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->branch->name}}</td>
                            <td>{{ $user->phone }}</td>
							
							<td>
							    @if($user->status != 1)
							        Not Active
							    @else
							        Active
							    @endif
							</td>
						
							

							<td class="text-center">
								<div class="dropdown">
									<button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Action
									</button>
									<form action="{{ route('users.destroy', $user['id']) }}" method="post">
									{{ csrf_field() }}
									<input name="_method" type="hidden" value="DELETE">

									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a href="{{ route('users.edit', $user['id']) }}" class="dropdown-item dropdown-edit dropdown-edit"><i class="icofont-ui-edit"></i> Edit</a>
										<a href="{{ route('users.show', $user['id']) }}" class="dropdown-item dropdown-edit dropdown-edit"><i class="bi bi-eye-fill"></i> View</a>
										<button class="btn-remove dropdown-item" type="submit"><i class="icofont-trash"></i> Delete</button>
									</div>
									</form>
								</div>
							</td>
						</tr>
						
					@endforeach
					
					@endif
            </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>


@endsection

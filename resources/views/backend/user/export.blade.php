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
                <table id="reportdata" class="table table-bordered data-table" >
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Location</th>
                            <th>Phone</th>
                            <th>BVN</th>
                            <th>NIN</th>
                            <th>Gender</th>
                            <th>DOB</th>
                            <th>Customer Home Address</th>
                            <th>Customer Bus Stop</th>
                            <th>Shop Address</th>
                            <th>Shop Bus Stop</th>
                            <th>Guarantor Name</th>
                            <th>Guarantor Phone Number</th>
                            <th>Guarantor Address</th>
                            <th>Nearest Bus Stop</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        
                @if(Auth::user()->user_type == 'manager')
                        @foreach($manager as $ma)
                            {!! $users->links() !!}
                           
                            <td>{{ $ma->first_name }}</td>
                            <td>{{ $ma->last_name }}</td>
                            <td>{{ $ma->branch->name}}</td>
                            <td>{{ $ma->phone }}</td>
                            <td>{{ $ma->bvn }}</td>
                            <td>{{ $ma->nin }}</td>
                            <td>{{ $ma->gender }}</td>
                            <td>{{ $ma->dob }}</td>
                            <td>{{ $ma->address}}</td>
                            <td>{{ $ma->hbus_stop }}</td>
                            <td>{{ $ma->shop_address }}</td>
                            <td>{{ $ma->sbus_stop }}</td>
                            <td>{{ $ma->gname}}</td>
                            <td>{{ $ma->gphone }}</td>
                            <td>{{ $ma->gaddress }}</td>
                            <td>{{ $ma->gbus_stop}}</td>
                            <td>{{ $ma->gphone }}</td>
                            
						</tr>
					@endforeach
					
                @else
                
                @foreach($users as $user)
                
                           
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->branch->name}}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->bvn }}</td>
                            <td>{{ $user->nin }}</td>
                            <td>{{ $user->gender }}</td>
                            <td>{{ $user->dob }}</td>
                            <td>{{ $user->address}}</td>
                            <td>{{ $user->hbus_stop }}</td>
                            <td>{{ $user->shop_address }}</td>
                            <td>{{ $user->sbus_stop }}</td>
                            <td>{{ $user->gname}}</td>
                            <td>{{ $user->gphone }}</td>
                            <td>{{ $user->gaddress }}</td>
                            <td>{{ $user->gbus_stop}}</td>

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

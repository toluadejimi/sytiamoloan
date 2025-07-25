@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-header d-flex align-items-center">
                <h4 class="header-title">{{ _lang('User List') }}</h4>
                <a class="btn btn-primary btn-sm ml-auto ajax-modal" data-title="{{ _lang('Create System User') }}"
                    href="{{ route('system_users.create') }}"><i class="icofont-plus-circle"></i> {{ _lang('Add New') }}</a>
            </div>

            <div class="card-body">
                <table id="users_table" class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>{{ _lang('First Name') }}</th>
                            <th>{{ _lang('Middle Name') }}</th>
                            <th>{{ _lang('Last Name') }}</th>
                            <th>{{ _lang('Phone No') }}</th>
                            <!--<th>{{ _lang('Email') }}</th>-->
                            <!--<th>{{ _lang('User Type') }}</th>-->
                            <th>{{ _lang('Role') }}</th>
                            <th>{{ _lang('Status') }}</th>
                            <th class="text-center">{{ _lang('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr data-id="row_{{ $user->id }}">
                            <td class='profile_picture text-center'><img
                                    src="{{ profile_picture($user->profile_picture) }}" class="thumb-sm img-thumbnail">
                            </td>
                            <td class='name'>{{ $user->first_name }}</td>
                            <td class='name'>{{ $user->middle_name }}</td>
                            <td class='name'>{{ $user->last_name }}</td>
                            <td class='name'>{{ $user->phone }}</td>
                            <!--<td class='email'>{{ $user->email }}</td>-->
                            <!--<td class='user_type'>{{ strtoupper($user->user_type) }}</td>-->
                            <td class='role_id'>{{ $user->role->name }}</td>
                            <td class='status'>{!! xss_clean(status($user->status)) !!}</td>
                            <td class="text-center">
                                <span class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown">
                                        {{ _lang('Action') }}
                                    </button>
                                    <form action="{{ action('SystemUserController@destroy', $user['id']) }}" method="post">
                                        {{ csrf_field() }}
                                        <input name="_method" type="hidden" value="DELETE">

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="{{ action('SystemUserController@edit', $user['id']) }}"
                                                data-title="{{ _lang('Update User') }}"
                                                class="dropdown-item"><i class="icofont-ui-edit"></i>
                                                {{ _lang('Edit') }}</a>
                                            <a href="{{ action('SystemUserController@show', $user['id']) }}"
                                                data-title="{{ _lang('View User') }}"
                                                class="dropdown-item ajax-modal"><i class="icofont-eye-alt"></i>
                                                {{ _lang('View') }}</a>
                                            <button class="btn-remove dropdown-item" type="submit"><i
                                                    class="icofont-trash"></i> {{ _lang('Delete') }}</button>
                                        </div>
                                    </form>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<div class="card no-export">
		    <div class="card-header d-flex align-items-center">
				@if(has_permission('support_tickets.create'))
				<a class="btn btn-primary btn-sm ml-auto ajax-modal" data-title="{{ _lang('Create New Ticket') }}" href="{{ route('support_tickets.create') }}"><i class="icofont-plus-circle"></i> {{ _lang('Add New') }}</a>
				@endif
			</div>
			<div class="card-body">
				<table  class="table table-bordered" >
					<thead>
					    <tr>
						    <th>Cutomer</th>
							<th>Subject</th>
							<th>status</th>
							<th>Created</th>
							<th class="text-center">{{ _lang('Action') }}</th>
					    </tr>
					    
					</thead>
					<tbody>
					  @foreach($support as $sp)
					    <tr>
					            <td>{{$sp->user->first_name}} {{$sp->user->last_name}}</td>
					            <td>{{$sp->subject}}</td>
					            <td>
					                @if($sp->status == 1)
					                    Active
					                @elseif($sp->status == 0)
					                    Pending
					                @elseif($sp->status == 2)
					                    Close
					               @endif
					            </td>
					            <td>{{ date("d-m-Y",strtotime($sp->created_at)) }}</td>
					            	<td class="text-center">
								<div class="dropdown">
									<button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Action
									</button>
									<form action="{{ action('SupportTicketController@destroy', $sp['id']) }}" method="post">
									{{ csrf_field() }}
									<input name="_method" type="hidden" value="DELETE">

									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a href="{{ action('SupportTicketController@show', $sp['id']) }}" class="btn btn-primary btn-sm"><i class="icofont-reply"></i> Reply</a>
										<a href="{{ route('support_tickets.mark_as_closed', $sp['id']) }}"class="btn btn-success btn-sm"><i class="icofont-check-circled"></i> Mark as closed</a>
										<button class="btn-remove dropdown-item" type="submit"><i class="icofont-trash"></i> Delete</button>
									</div>
									</form>
								</div>
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


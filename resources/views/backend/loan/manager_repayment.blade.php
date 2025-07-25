@extends('layouts.app')

@section('content')
@if(Auth::user()->user_type == 'rmafo')
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<span class="panel-title">{{ _lang('Disbursment Repayment') }}</span>
			</div>
			<div class="card-body">
				<form method="post" class="validate" autocomplete="off" action="{{ route('manager_repayment') }}" enctype="multipart/form-data">
					{{ csrf_field() }}
				<div class="row">
					<div class="col-md-6">
					    <div class="form-group">
								<label class="control-label">{{ _lang('Enter Amount') }}</label>
								<input type="text" class="form-control" name="amount" value="{{ old('amount')  }}" required >
							</div>
					</div>
					<div class="col-md-12">
        			<div class="form-group">
        				
        				<button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Save') }}</button>
        			</div>
        		</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="card p-2 mt-1">
 <table id="loan_products_table" class="table  table-bordered data-table ">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Disbusment Repayment </th>
                    <!--<th>Location</th>-->
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
                
            </thead>
            <tbody>
               
                @foreach($mn as $ma )
                <td>{{ date("d-m-Y",strtotime($ma->created_at)) }}</td>
                            <td>{{ $ma->txid }}</td>
                            <!--<td>{{-->
                            <!--$ma->location->name-->
                            
                            <!--}}</td>-->
							<td >₦{{ number_format($ma->amount,2) }}</td>
						    @if($ma->status == 1)
						           <td>{!! xss_clean(show_status(_lang('Approved'), 'success')) !!}
						          </td>
						        @else
						           <td>{!! xss_clean(show_status(_lang('Pending'), 'warning')) !!}</td>
						        @endif
							
                            @if($ma->status == 0)
							<td class="text-center">
								<div class="dropdown">
									<button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Action
									</button>
									<form action="{{ route('loans.repayDestroy', $ma['id']) }}" method="post">
									{{ csrf_field() }}
									<input name="_method" type="hidden" value="DELETE">

									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a href="{{ route('loans.repaymentEdit', $ma['id']) }}" class="dropdown-item dropdown-edit dropdown-edit"><i class="icofont-ui-edit"></i> Edit</a>
										<!--<a href="{{ route('loans.show', $ma['id']) }}" class="dropdown-item dropdown-edit dropdown-edit"><i class="bi bi-eye-fill"></i> View</a>-->
										<button class="btn-remove dropdown-item" type="submit"><i class="icofont-trash"></i> Delete</button>
									</div>
									</form>
								</div>
							</td>
							@endif
						</tr>
						@endforeach
            </tbody>
					
        </table>
        
</div>
@elseif(Auth::user()->user_type == 'admin')
<div class="card p-2">
 <table id="loan_products_table" class="table  table-bordered data-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Disbusment Repayment</th>
                    <th>Manager</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
                
            </thead>
            <tbody>
               
                @foreach($mr as $ma )
                <td>{{ date("d-m-Y",strtotime($ma->created_at)) }}</td>
                            <td>{{ $ma->txid }}</td>
                            <td>{{ $ma->user->first_name }} {{ $ma->user->last_name }}</td>
							<td >₦{{ number_format($ma->amount,2) }}</td>
						   @if($ma->status == 1)
						           <td>{!! xss_clean(show_status(_lang('Approved'), 'success')) !!}
						          </td>
						        @else
						           <td><a class="btn btn-outline-primary btn-sm" href="{{ action('LoanController@repayapproved', $ma['id']) }}"><i class="icofont-check-circled"></i> {{ _lang("Click to Approve") }}</a></td>
						        @endif
							

							<!--<td class="text-center">-->
							<!--	<div class="dropdown">-->
							<!--		<button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
							<!--		Action-->
							<!--		</button>-->
							<!--		<form action="{{ route('loans.managerDestroy', $ma['id']) }}" method="post">-->
							<!--		{{ csrf_field() }}-->
							<!--		<input name="_method" type="hidden" value="DELETE">-->

							<!--		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">-->
							<!--			<a href="{{ route('loans.managerEdit', $ma['id']) }}" class="dropdown-item dropdown-edit dropdown-edit"><i class="icofont-ui-edit"></i> Edit</a>-->
										<!--<a href="{{ route('loans.show', $ma['id']) }}" class="dropdown-item dropdown-edit dropdown-edit"><i class="bi bi-eye-fill"></i> View</a>-->
							<!--			<button class="btn-remove dropdown-item" type="submit"><i class="icofont-trash"></i> Delete</button>-->
							<!--		</div>-->
							<!--		</form>-->
							<!--	</div>-->
							<!--</td>-->
						</tr>
						@endforeach
            </tbody>
					
        </table>
         
</div>
@endif
@endsection

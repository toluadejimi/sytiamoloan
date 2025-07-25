@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-sm-4">
			<div class="card mb-4 border-bottom-card border-primary">
				<div class="card-body">
					<div class="d-flex">
						<div class="flex-grow-1">
							<h5>{{ _lang('Active Users') }}</h5>
							<h6 class="pt-1 mb-0"><b>{{ $active_customer }}</b></h6>
						</div>
						<div>
							<a href="{{ route('users.filter') }}/active"><i class="icofont-arrow-right"></i>{{ _lang('View') }}</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="card mb-4 border-bottom-card border-warning">
				<div class="card-body">
					<div class="d-flex">
						<div class="flex-grow-1">
							<h5>{{ _lang('Loan Requests') }}</h5>
							<h6 class="pt-1 mb-0"><b>{{ $pending_loan }}</b></h6>
						</div>
						<div>
							<a href="{{ route('loans.index') }}"><i class="icofont-arrow-right"></i>{{ _lang('View') }}</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="card mb-4 border-bottom-card border-secondary">
				<div class="card-body">
					<div class="d-flex">
						<div class="flex-grow-1">
							<h5>{{ _lang('Approved Loan') }}</h5>
							<h6 class="pt-1 mb-0"><b>{{ $approved_loan }}</b></h6>
						</div>
						<div>
							<a href="{{ route('loans.index') }}"><i class="icofont-arrow-right"></i>{{ _lang('View') }}</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card mb-4 border-bottom-card border-success">
				<div class="card-body">
					<div class="d-flex">
						<div class="flex-grow-1">
							<h5>{{ _lang('Total Inflow') }}</h5>
							<h6 class="pt-1 mb-0"><b>₦{{ number_format($inflow) }}</b></h6>
						</div>
						<div>
							<i class="icofont-arrow-down"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card mb-4 border-bottom-card border-danger">
				<div class="card-body">
					<div class="d-flex">
						<div class="flex-grow-1">
							<h5>{{ _lang('Total Outflow') }}</h5>
							<h6 class="pt-1 mb-0"><b>₦{{ number_format($outflow) }}</b></h6>
						</div>
						<div>
							<i class="icofont-arrow-up"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>

	<div class="card mb-4">
		<div class="card-header">
			{{ _lang('Recent Transactions') }}
		</div>
		<div class="card-body">
        <table  class="table  table-bordered ">
            <thead>
                <tr>
                    <th>Loan ID</th>
                    <th>Location</th>
                    <th>Borrower</th>
                    <th>Amount</th>
                    <th>Release Date</th>
                    <th>Total Payable</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($tran->slice(0, 10) as $tran )
                            <td>{{ $tran->loan_id }}</td>
                            <td>{{ $tran->branch->name}}</td>
                            <td>{{ $tran->borrower->first_name }} {{ $tran->borrower->last_name }}</td>
							
							<td >₦{{ number_format($tran->applied_amount,2) }}</td>
							<td>{{ $tran->release_date }}</td>
							<td>₦{{number_format($tran->total_payable,2)}}</td>
						    @if($tran->status == 1)
						           <td><span class="badge badge-success">Approved</span></td>
						        @elseif($tran->status == 2)
						            <td><span class="badge badge-info">Completed</span></td>
						        @elseif($tran->status == 3)
						            <td><span class="badge badge-danger">Rejected</span></td>
						        @elseif($tran->status == 4)
						           <td><span class="badge badge-success">Paid</span></td>
						      @else
						           <td><span class="badge badge-warning">Pending</span></td>
						        @endif
							

						</tr>
						@endforeach
            </tbody>
        </table>
         
    </div>
	</div>
@endsection

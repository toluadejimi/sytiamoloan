@extends('layouts.app')

@section('content')
    <div class="row">
		<div class="col">
			<div class="card mb-4 border-bottom-card border-success">
				<div class="card-body">
					<div class="d-flex">
						<div class="flex-grow-1">
							<h5>{{ _lang('Total Inflow') }}</h5>
							<h6 class="pt-1 mb-0"><b>₦{{ number_format($tamount) }}</b></h6>
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
							<h6 class="pt-1 mb-0"><b>₦{{ number_format($tapplied) }}</b></h6>
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
        <table id="loan_products_table"  class="table  table-bordered data-table">
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
                
                @foreach($trasn->slice(0, 10) as $tran )
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

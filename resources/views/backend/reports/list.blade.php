@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header d-flex align-items-center">
        <span class="panel-title">Reports List</span>
    </div>
    <div class="card-body">
        <form action="{{route('reports.index')}}" method="get">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="container-fluid">
                        <div class="form-group row">
                            <label for="datefrom" class="col-sm-2"> Date From</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" name="datefrom" id="datefrom">
                            </div>
                            <label for="datefrom" class="col-sm-2"> Date to</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" name="dateto" id="dateto">
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" name="search" title="search" class="btn"><img src="https://img.icons8.com/material-rounded/24/000000/search.png"/></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <table id="reportdata" class="table  table-bordered data-table">
            
            <thead>
                <tr>
                    <th>Loan ID</th>
                    <th>Location</th>
                    <th>Borrower</th>
                    <th>Phone No</th>
                    <th>Amount</th>
                    <th>Release Date</th>
                    <th>Total Payable</th>
                    <th>Total Paid</th>
                    <th>Status</th>
                    
                </tr>
            </thead>
            <tbody>
                
                @foreach($reports as $reports )
                            <td>{{ $reports->loan_id }}</td>
                            <td>{{ $reports->branch->name}}</td>
                            <td>{{ $reports->borrower->first_name }} {{ $reports->borrower->last_name }}</td>
                            <td>{{ $reports->borrower->phone }}</td>
							<td >NGN {{ number_format($reports->applied_amount,2) }}</td>
							<td>{{ $reports->release_date }}</td>
							<td>NGN {{ number_format($reports->total_payable,2) }}</td>
                            <td>NGN {{ number_format($reports->total_paid,2) }}</td>
						    @if($reports->status == 1)
						           <td> Approved</td>
						        @elseif($reports->status == 2)
						            <td>Completed</td>
						        @elseif($reports->status == 3)
						            <td>Rejected</td>
						        @else
						           <td> Pending</td>
						        @endif
							

							
						</tr>
                       
						@endforeach
                       
            </tbody>
            
            
        </table>
        
        {{-- {{ $reports->links() }} --}}

    </div>
</div>




@endsection






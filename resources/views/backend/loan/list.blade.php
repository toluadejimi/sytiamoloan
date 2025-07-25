@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <span class="panel-title">Loan List</span>
           
            <div class="ml-auto">
                
                
                <a class="btn btn-primary btn-sm" href="{{ route('loans.create') }}"><i class="icofont-plus-circle"></i> Add New</a>
            </div>
        </div>
    @if(Auth::user()->user_type == 'manager' )
        <div class="card-body">
            <div class="row">
            @foreach($location as $ma )
                <div class="col-sm-2">
                    <form action="{{route('loans.manager_list')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$ma->id}}">
                         <input class="btn btn-primary m-2" type="submit" value="{{$ma->name}}">
                    </form>
                </div>
            @endforeach
            </div>
        <table id="loan_products_table" class="table  table-bordered data-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <!--<th>Loan ID</th>-->
                    <th>Agent Name</th>
                    <th>Location</th>
                    <th>Borrower</th>
                    <th>Amount</th>
                    <th>Total Payable</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                    
                </tr>
                
            </thead>
            <tbody>
               
                @foreach($manager as $ma )
                <td>{{ date("d-m-Y",strtotime($ma->created_at)) }}</td>
                            <!--<td>{{ $ma->loan_id }}</td>-->
                            <td>{{ $ma->created_by->first_name }} {{ $ma->created_by->middle_name }} {{ $ma->created_by->last_name }}</td>
                            <td>{{ $ma->branch->name}}</td>
                            <td><a href="{{ route('users.show', $ma['borrower_id']) }}">{{ $ma->borrower->first_name }} {{ $ma->borrower->last_name }}</a></td>
							
							<td >₦{{ number_format($ma->applied_amount,2) }}</td>
							<!--<td>{{ $ma->first_payment_date }}</td>-->
							<td>₦{{ number_format($ma->total_payable,2)}}</td>
						    @if($ma->status == 1)
						           <td> {!! xss_clean(show_status(_lang('Approved'), 'success')) !!}</td>
						        @elseif($ma->status == 2)
						            <td>{!! xss_clean(show_status(_lang('Completed'), 'info')) !!}</td>
						        @elseif($ma->status == 3)
						            <td>{!! xss_clean(show_status(_lang('Rejected'), 'danger')) !!}</td>
						        @else
						           <td> {!! xss_clean(show_status(_lang('Pending'), 'warning')) !!}</td>
						        @endif
							

							<td class="text-center">
								<div class="dropdown">
									<button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Action
									</button>
									<form action="{{ route('loans.destroy', $ma['id']) }}" method="post">
									{{ csrf_field() }}
									<input name="_method" type="hidden" value="DELETE">

									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a href="{{ route('loans.edit', $ma['id']) }}" class="dropdown-item dropdown-edit dropdown-edit"><i class="icofont-ui-edit"></i> Edit</a>
										<a href="{{ route('loans.show', $ma['id']) }}" class="dropdown-item dropdown-edit dropdown-edit"><i class="bi bi-eye-fill"></i> View</a>
										<!--<button class="btn-remove dropdown-item" type="submit"><i class="icofont-trash"></i> Delete</button>-->
									</div>
									</form>
								</div>
								
							</td>
						
						</tr>
						@endforeach
            </tbody>
						<tr>
                 
                  <td colspan="4">Total</td>
                  <td>₦{{ number_format($manager->sum('applied_amount'),2) }}</td>
                </tr>
        </table>
    </div>
    @else
        <div class="card-body">
        <table id="loan_products_table" class="table  table-bordered data-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Loan ID</th>
                    <th>Agent Name</th>
                    <th>Location</th>
                    <th>Borrower</th>
                    <th>Amount</th>
                    <!--<th>Payment Date</th>-->
                    <th>Total Payable</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                    
                </tr>
            </thead>
            <tbody>
                
                @foreach($loans as $loan )
                <td>{{ date("d-m-Y",strtotime($loan->created_at)) }}</td>
                            <td>{{ $loan->loan_id }}</td>
                            <td>{{ $loan->created_by->first_name }} {{ $loan->created_by->middle_name }} {{ $loan->created_by->last_name }}</td>
                            <td>{{ $loan->branch->name}}</td>
                            <td><a href="{{ route('users.show', $loan['borrower_id']) }}">{{ $loan->borrower->first_name }} {{ $loan->borrower->last_name }}</a></td>
							
							<td >₦{{ number_format($loan->applied_amount,2) }}</td>
							<!--<td>{{ $loan->first_payment_date }}</td>-->
							<td>₦{{ number_format($loan->total_payable,2)}}</td>
						    @if($loan->status == 1)
						           <td> Approved</td>
						        @elseif($loan->status == 2)
						            <td>Completed</td>
						        @elseif($loan->status == 3)
						            <td>Rejected</td>
						        @else
						           <td> Pending</td>
						        @endif
							

							<td class="text-center">
								<div class="dropdown">
									<button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Action
									</button>
									<form action="{{ route('loans.destroy', $loan['id']) }}" method="post">
									{{ csrf_field() }}
									<input name="_method" type="hidden" value="DELETE">

									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a href="{{ route('loans.edit', $loan['id']) }}" class="dropdown-item dropdown-edit dropdown-edit"><i class="icofont-ui-edit"></i> Edit</a>
										<a href="{{ route('loans.show', $loan['id']) }}" class="dropdown-item dropdown-edit dropdown-edit"><i class="bi bi-eye-fill"></i> View</a>
										<button class="btn-remove dropdown-item" type="submit"><i class="icofont-trash"></i> Delete</button>
									</div>
									</form>
								</div>
								@if($loan->status == 0)
								<a class="btn btn-primary btn-sm m-2" href="{{ action('LoanController@approve', $loan['id']) }}"> {{ _lang("Approve") }}</a>
								@endif
								@if($loan->status == 1)
								<a class="btn btn-primary btn-sm m-2" href="{{ action('LoanController@disapproved', $loan['id']) }}"> {{ _lang("Disapprove") }}</a>
								@endif
							</td>
								
							    
							
						</tr>
						@endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>




<script type="text/javascript">
  $(function () {
      
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('users.index') }}",
          data: function (d) {
                d.status = $('#status').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'first_name', first_name: 'first_name'},
            {data: 'applied_amount', name: 'applied_amount'},
            {data: 'status', name: 'status'},
        ]
    });
  
    $('#status').change(function(){
        table.draw();
    });
      
  });
</script>
@endsection


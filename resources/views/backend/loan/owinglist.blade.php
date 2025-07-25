@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <span class="panel-title">Uncompleted Customers </span>
           
            <div class="ml-auto">
                
                
                <a class="btn btn-primary btn-sm" href="{{ route('loans.create') }}"><i class="icofont-plus-circle"></i> Add New</a>
            </div>
        </div>
    @if(Auth::user()->user_type == 'rmafo')
       
    @else
        <div class="card-body">
        <table id="loan_products_table" class="table  table-bordered data-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Loan ID</th>
                    <th>Location</th>
                    <th>Borrower</th>
                    <th>Phone No</th>
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
                            <td >{{ $loan->branch->name}}</td>
                            <td><a href="{{ route('users.show', $loan['borrower_id']) }}">{{ $loan->borrower->first_name }} {{ $loan->borrower->last_name }}</a></td>
                            <td>{{ $loan->borrower->phone }}</td>
							
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
								<!--<div class="dropdown">-->
								<!--	<button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
								<!--	Action-->
								<!--	</button>-->
								<!--	<form action="{{ route('loans.destroy', $loan['id']) }}" method="post">-->
								<!--	{{ csrf_field() }}-->
								<!--	<input name="_method" type="hidden" value="DELETE">-->

								<!--	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">-->
								<!--		<a href="{{ route('loans.edit', $loan['id']) }}" class="dropdown-item dropdown-edit dropdown-edit"><i class="icofont-ui-edit"></i> Edit</a>-->
								<!--		<a href="{{ route('loans.show', $loan['id']) }}" class="dropdown-item dropdown-edit dropdown-edit"><i class="bi bi-eye-fill"></i> View</a>-->
								<!--		<button class="btn-remove dropdown-item" type="submit"><i class="icofont-trash"></i> Delete</button>-->
								<!--	</div>-->
								<!--	</form>-->
								<!--</div>-->
								<a href="{{ route('loans.show', $loan['id']) }}" class="btn btn-primary"><i class="bi bi-eye-fill"></i> View</a>
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


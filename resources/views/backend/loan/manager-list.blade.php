@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <span class="panel-title">Loan List</span>
           
            <div class="ml-auto">
                
                
                <a class="btn btn-primary btn-sm" href="{{ route('loans.manager_request_view') }}"><i class="icofont-plus-circle"></i> Request for Disbursment</a>
            </div>
        </div>

        <div class="card-body">
            
        <table id="loan_products_table" class="table  table-bordered data-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Loan ID</th>
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
               
                @foreach($manager as $ma )
                <td>{{ date("d-m-Y",strtotime($ma->created_at)) }}</td>
                            <td>{{ $ma->loan_id }}</td>
                            <td>{{ $ma->branch->name}}</td>
                            <td>{{ $ma->borrower->first_name }} {{ $ma->borrower->last_name }}</td>
							
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
										<!--<a href="{{ route('loans.edit', $ma['id']) }}" class="dropdown-item dropdown-edit dropdown-edit"><i class="icofont-ui-edit"></i> Edit</a>-->
										<a href="{{ route('loans.show', $ma['id']) }}" class="dropdown-item dropdown-edit dropdown-edit"><i class="bi bi-eye-fill"></i> View</a>
										<button class="btn-remove dropdown-item" type="submit"><i class="icofont-trash"></i> Delete</button>
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


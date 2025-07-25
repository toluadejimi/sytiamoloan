@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header d-flex align-items-center">
        <span class="panel-title">Reports List</span>
    </div>
    <div class="card-body">
        <form action="{{route('reports.quaryafosdata')}}" method="post">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="container-fluid">
                        <div class="form-group row">
                            
                            <div class="col-md-6">
                                <label for="datefrom">Select Date From</label>
                                <input type="date" class="form-control" name="datefrom" id="datefrom">
                            </div>
                            
                            <div class="col-md-6">
                                <label for="datefrom">Select Date To</label>
                                <input type="date" class="form-control" name="dateto" id="dateto">
                            </div>
                            
                           
		                </div>
		                
		                <div class="form-group row">
		  
                               <div class="col-md-6">
			                       <label class="control-label">Select Agent</label>
                        				<select class="form-control auto-select select2 mselect" data-selected="" name="afo" id="afo"  required>
                        				 @foreach($afos as $afo )
                        				<option value="{{ $afo->id  }}">{{ $afo->first_name  }} {{ $afo->last_name }}</option>
                        				@endforeach
                        				</select>
                			    </div>
                			 
                			 
                			 <div class="col-md-3">
                                <div class="form-group">
                                    <!--<button type="submit"  title="search" class="btn"> </button>-->
                                    <button type="submit" name="search" class="btn btn-primary btn-lg"><i class="icofont-check-circled"></i> {{ _lang('Search') }}</button>
                                </div>
                            </div>    
                			 
                			 
                        </div>   
                            
                            
                            
                            
                            
                            
           
				
		
                  
                            
                 </div>
                        
            
                        
                </div>
            </div>
    
        </form>




        <table id="reportdata loan_products_table" class="table  table-bordered data-table">
            
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Loan ID</th>
                    <th>Agent</th>
                    <th>Location</th>
                    <th>Borrower</th>
                    <th>Amount</th>
                    <th>Total Paid</th>
                    
                </tr>
            </thead>
            <tbody>
                
                @foreach($reports as $reports )
                            <td>{{ $reports->created_at }}</td>
                            <td>{{ $reports->loan_id }}</td>
                            <td>{{ $reports->user->first_name }} {{ $reports->user->last_name }}</td>
                            <td>{{ $reports->branch->name}}</td>
                            <td>{{ $reports->borrower->first_name}} {{ $reports->user->middle_name }} {{ $reports->user->last_name }}</td>
							<td >NGN{{ number_format($reports->total_paid,2) }}</td>
	
						    @if($reports->status == 4)
						           <td> Paid</td>
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
            <tr>
                 
                  <td colspan="5">Total</td>
                  <td><h3>₦{{ number_format($sum,2) }}</h3></td>
                </tr>
            
        </table>
        
        {{-- {{ $reports->links() }} --}}

    </div>
</div>


<script>
        $(document).ready(function() {
            $('#reportdata').dataTable( {
				"bDestroy": true,
			
                responsive: true,

                dom: '<"html5buttons"B>1Tfgitp',
                buttons: [
                    { extend: 'copy'}, 
                    { extend: 'excel', title:'ReportFile'}
                    // { extend:'excel', title:'ReportFile', 
                    //     customize: function (win){
                    //         $(win.document.body).addClass('white-bg');
                    //         $(win.document.body).css('font-size', '10px');

                    //         $(win.document.body).find('table')
                    //         .addClass('compact')
                    //         .css('font-size', 'inherit');

                    //     }
                    //     }
                     
                ]
				
            } );
        } );
    </script>




@endsection






@extends('layouts.app')

@section('content')
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <span class="panel-title">{{ _lang("View Loan Details") }}</span>
         </div>
         <div class="card-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
               <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#loan_details">{{
                  _lang("Loan Details")
                  }}</a>
               </li>
               
               <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#schedule">{{
                  _lang("Repayments Schedule")
                  }}</a>
               </li>
               @if(Auth::user()->user_type == 'admin')
               <li class="nav-item">
                  <a
                     class="nav-link"
                     href="{{ action('LoanController@edit', $loan['id']) }}"
                     >{{ _lang("Edit") }}</a
                     >
               </li>
               @endif
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <div class="tab-pane active" id="loan_details">
                  @if($loan->status == 0)
                  <div class="alert alert-warning mt-4">
                     <p>
                        {{ _lang("Add Loan ID, Release Date and First Payment Date before approving loan request") }}
                     </p>
                  </div>
                  @endif
                  <table class="table table-bordered mt-4">
                     <tr>
                        <td>{{ _lang("Loan ID") }}</td>
                        <td>{{ $loan->loan_id }}</td>
                     </tr>
                     <tr>
                        <td>{{ _lang("Borrower") }}</td>
                        <td>{{ $loan->borrower->first_name }} {{ $loan->borrower->last_name }}</td>
                     </tr>
                     <tr>
                        <td>{{ _lang("Phone No") }}</td>
                        <td>{{ $loan->borrower->phone }}</td>
                     </tr>
                     <tr>
                        <td>{{ _lang("Status") }}</td>
                        <td>
                            @if($loan->status == 0)
                                {!! xss_clean(show_status(_lang('Pending'), 'warning')) !!}
                            @elseif($loan->status == 1)
                                {!! xss_clean(show_status(_lang('Approved'), 'success')) !!}
                            @elseif($loan->status == 2)
                                {!! xss_clean(show_status(_lang('Completed'), 'info')) !!}
                            @elseif($loan->status == 3)
                                {!! xss_clean(show_status(_lang('Cancelled'), 'danger')) !!}
                            @elseif($loan->status == 4)
                                {!! xss_clean(show_status(_lang('Paid'), 'success')) !!}
                            @endif

                            @if(Auth::user()->user_type == 'admin')
                           @if($loan->status == 0 )
                           <a class="btn btn-outline-primary btn-sm" href="{{ action('LoanController@approve', $loan['id']) }}"><i class="icofont-check-circled"></i> {{ _lang("Approve Loan") }}</a>
                           <a class="btn btn-outline-danger btn-sm float-right" href="{{ action('LoanController@reject', $loan['id']) }}"><i class="icofont-close-line-circled"></i> {{ _lang("Click to Reject") }}</a>
                           @elseif($loan->status == 1)
                            <a class="btn btn-outline-primary btn-sm" href="{{ action('LoanController@completed', $loan['id'], $loan['loan_id']) }}"><i class="icofont-check-circled"></i> {{ _lang("Complete Loan") }}</a
                              >
                           <a class="btn btn-outline-danger btn-sm float-right" href="{{ action('LoanController@disapproved', $loan['id']) }}"><i class="icofont-close-line-circled"></i> {{ _lang("Disapprove Loan") }}</a>
                           @elseif($loan->status == 4)
                            <a class="btn btn-outline-primary btn-sm" href="{{ action('LoanController@completed', $loan['id'], $loan['loan_id']) }}"><i class="icofont-check-circled"></i> {{ _lang("Completed") }}</a
                              >
                
                          
                           @endif
                           @endif
                        </td>
                     </tr>
                     <!--<tr>-->
                     <!--   <td>{{ _lang("Loan Payment Date") }}</td>-->
                     <!--   <td>{{ $loan->first_payment_date }}</td>-->
                     <!--</tr>-->
                     <tr>
                        <td>{{ _lang("Disbursement Date") }}</td>
                        <td>
                           {{ $loan->release_date != '' ? $loan->release_date : '' }}
                        </td>
                     </tr>
                     <tr>
                        <td>{{ _lang("Loan Duration") }}</td>
                        <td>
                           {{ $loan->duration }} weeks
                        </td>
                     </tr>
                     <tr>
                        <td>{{ _lang("Applied Amount") }}</td>
                        <td>
                           {{ decimalPlace($loan->applied_amount, $loan->currency->name) }}
                        </td>
                     </tr>
                     <tr>
                        <td>{{ _lang("Total Payable") }}</td>
                        <td>
                           {{ decimalPlace($loan->total_payable ) }}
                        </td>
                     </tr>
                     <tr>
                        <td>{{ _lang("Loan Interest") }}</td>
                        <td>
                           @if($loan->status == 0)
                            Once approved the interest will be deducted from the amount payable
                           @elseif($loan->status == 1)
                            Interest Successfully Deducted
                           @endif
                        </td>
                     </tr>
                     <tr>
                        <td>{{ _lang("Total Paid") }}</td>
                        <td class="text-success">
                           {{ decimalPlace($loan->total_paid, $loan->currency->name) }}
                        </td>
                     </tr>
                     <tr>
                        <td>{{ _lang("Due Amount") }}</td>
                        <td class="text-danger">
                           {{ decimalPlace($loan->total_payable - $loan->total_paid, $loan->currency->name) }}
                        </td>
                     </tr>
                     <tr>
                        <td>{{ _lang("Late Payment Penalties") }}</td>
                        <td>{{ $loan->late_payment_penalties }} %</td>
                     </tr>
                     <tr>
                        <td>{{ _lang("Attachment") }}</td>
                        <td>
                           {!! $loan->attachment == "" ? '' : '<a
                              href="'. asset('public/uploads/media/'.$loan->attachment) .'"
                              target="_blank"
                              >'._lang('Download').'</a
                              >' !!}
                        </td>
                     </tr>
                     @if($loan->status == 1)
                     <tr>
                        <td>{{ _lang("Approved Date") }}</td>
                        <td>{{ $loan->approved_date }}</td>
                     </tr>
                     @endif
                     <tr>
                        <td>{{ _lang("Description") }}</td>
                        <td>{{ $loan->description }}</td>
                     </tr>
                     <tr>
                        <td>{{ _lang("Remarks") }}</td>
                        <td>{{ $loan->remarks }}</td>
                     </tr>
                  </table>
               </div>
               <div class="tab-pane fade" id="collateral">
                  <div class="card">
                     <div class="card-header d-flex align-items-center">
                        <span>{{ _lang("All Collaterals") }}</span>
                        <a
                           class="btn btn-primary btn-sm ml-auto"
                           href="{{ route('loan_collaterals.create',['loan_id' => $loan->id]) }}"
                           ><i class="icofont-plus-circle"></i>
                        {{ _lang("Add New Collateral") }}</a
                           >
                     </div>
                     <div class="card-body">
                        <div class="table-responsive">
                           <table class="table table-bordered mt-2">
                              <thead>
                                 <tr>
                                    <th>{{ _lang("Name") }}</th>
                                    <th>{{ _lang("Collateral Type") }}</th>
                                    <th>{{ _lang("Serial Number") }}</th>
                                    <th>{{ _lang("Estimated Price") }}</th>
                                    <th class="text-center">{{ _lang("Action") }}</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach($loancollaterals as $loancollateral)
                                 <tr data-id="row_{{ $loancollateral->id }}">
                                    <td class="name">{{ $loancollateral->name }}</td>
                                    <td class="collateral_type">
                                       {{ $loancollateral->collateral_type }}
                                    </td>
                                    <td class="serial_number">
                                       {{ $loancollateral->serial_number }}
                                    </td>
                                    <td class="estimated_price">
                                       {{ decimalPlace($loancollateral->estimated_price, currency($loan->currency->name)) }}
                                    </td>
                                    <td class="text-center">
                                       <div class="dropdown">
                                          <button
                                             class="btn btn-primary dropdown-toggle btn-sm"
                                             type="button"
                                             id="dropdownMenuButton"
                                             data-toggle="dropdown"
                                             aria-haspopup="true"
                                             aria-expanded="false"
                                             >
                                          {{ _lang("Action") }}
                                          </button>
                                          <form
                                             action="{{
                                             action(
                                             'LoanCollateralController@destroy',
                                             $loancollateral['id']
                                             )
                                             }}"
                                             method="post"
                                             >
                                             {{ csrf_field() }}
                                             <input
                                                name="_method"
                                                type="hidden"
                                                value="DELETE"
                                                />
                                             <div
                                                class="dropdown-menu"
                                                aria-labelledby="dropdownMenuButton"
                                                >
                                                <a
                                                   href="{{
                                                   action(
                                                   'LoanCollateralController@edit',
                                                   $loancollateral['id']
                                                   )
                                                   }}"
                                                   class="
                                                   dropdown-item dropdown-edit dropdown-edit
                                                   "
                                                   ><i class="mdi mdi-pencil"></i>
                                                {{ _lang("Edit") }}</a
                                                   >
                                                <a
                                                   href="{{
                                                   action(
                                                   'LoanCollateralController@show',
                                                   $loancollateral['id']
                                                   )
                                                   }}"
                                                   class="
                                                   dropdown-item dropdown-view dropdown-view
                                                   "
                                                   ><i class="mdi mdi-eye"></i>
                                                {{ _lang("View") }}</a
                                                   >
                                                <button
                                                   class="btn-remove dropdown-item"
                                                   type="submit"
                                                   >
                                                <i class="mdi mdi-delete"></i>
                                                {{ _lang("Delete") }}
                                                </button>
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
               <div class="tab-pane fade mt-4" id="schedule">
                  <table class="table table-bordered data-table">
                     <thead>
                        <tr>
                           <th>{{ _lang("Date") }}</th>
                           <th class="text-right">{{ _lang("Loan ID") }}</th>
                           <th class="text-right">{{ _lang("Amount Paid") }}</th>
                           <th class="text-right">{{ _lang("Balance") }}</th>
                           <th class="text-right">{{ _lang("Agent Name") }}</th>
                           <th class="text-center">{{ _lang("Status") }}</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($repay as $repay)
                        <tr>
                           <td>{{ date("d-m-Y",strtotime($repay->created_at)) }}</td>
                           <td class="text-right">
                              {{ $repay->loan_id }}
                           </td>
                           <td class="text-right">
                              {{ decimalPlace($repay['total_paid']) }}
                           </td>
                           
                           <td class="text-right">
                              {{ decimalPlace($repay['balance']) }}
                           
                           <td class="text-right">
                              {{ $repay->user->first_name }} {{ $repay->user->last_name }}
                              
                           </td>
                           
                           <td class="text-center">
                              @if($repay->status == 4)
                                {!! xss_clean(show_status(_lang('Paid'), 'success')) !!}
                              @endif
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
               <div class="tab-pane fade mt-4" id="repayments">
                  <table class="table table-bordered data-table">
                     <thead>
                        <tr>
                           <th>Borrower</th>
                           <th class="text-right">Amount</th>
                           <th class="text-right">Status</th>
                           <th class="text-right">Late Penalty</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($payments as $payment)
                        <tr>
                           <td>{{ $payment->paid_at }}</td>
                           <td class="text-right">
                              {{ decimalPlace($payment['interest'], currency($loan->currency->name)) }}
                           </td>
                           <td class="text-right">
                              {{ decimalPlace($payment['amount_to_pay'], currency($loan->currency->name)) }}
                           </td>
                           <td class="text-right">
                              {{ decimalPlace($payment['penalty'], currency($loan->currency->name)) }}
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('js-script')
<script>
   (function($) {
       "use strict";

   	$('.nav-tabs a').on('shown.bs.tab', function(event){
   		var tab = $(event.target).attr("href");
   		var url = "{{ route('loans.show',$loan->id) }}";
   	    history.pushState({}, null, url + "?tab=" + tab.substring(1));
   	});

   	@if(isset($_GET['tab']))
   	   $('.nav-tabs a[href="#{{ $_GET['tab'] }}"]').tab('show');
   	@endif

   })(jQuery);
</script>
@endsection
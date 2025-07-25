<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Loan;
use App\Models\Branch;
use App\Models\LoanCollateral;
use App\Models\LoanPayment;
use App\Models\LoanRepayment;
use App\Models\Repayment;
use App\Models\AppNotification;
use App\Models\LoanProduct;
use App\Models\Transaction;
use App\Models\Manager;
use App\Models\MRepayment;
use App\Models\User;
use App\Notifications\ApprovedLoanRequest;
use App\Notifications\RejectLoanRequest;
use App\Utilities\LoanCalculator as Calculator;
use Auth;
use App\Users\UserController;
use DataTables;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$loans = Loan::all();
        $users = User::all();
        $loans = Loan::latest()->orderBy('created_at', 'desc')->take('200')->get();
       
        $b_id = explode(",",Auth::user()->branch_id);
        
        //dd($loans);
        
        
       $manager =  Loan::with('user')->whereIn('branch_id',$b_id)->get();
       $location =  Branch::whereIn('id',$b_id)->get();
    
       //dd($location);
        return view('backend.loan.list', compact('loans', 'users','manager','location'));
        
    }
    
    public function uncompleted(){
         $loans =  Loan::with('user')->where('status',1)->orderBy('created_at', 'desc')->get();;
         $users = User::all();
        return view('backend.loan.owinglist', compact('loans'));
    }
    
     public function pending(){
         $loans =  Loan::with('user')->where('status',0)->orderBy('created_at', 'desc')->get();;
         $users = User::all();
        //  dd($loans);
        return view('backend.sort.pending', compact('loans'));
    }
    
    public function approved(){
         $loans =  Loan::with('user')->where('status',1)->orderBy('created_at', 'desc')->get();;
         $users = User::all();
        //  dd($loans);
        return view('backend.sort.approved', compact('loans'));
    }
    
    public function manager_list(Request $request)
    {
        $lc = $request->input('id');
        $manager =  Loan::where('branch_id',$lc)->get();
        
        return view('backend.loan.manager-list', compact('manager'));
    }
    
    public function manager_request_view(Request $request) 
    {
        
         
         $b_id = explode(",",Auth::user()->branch_id);
        //  $m =  Manager::whereIn('locations',$b_id)->pluck('locations');
        //  $b_ids = explode(",",$m);
        //  dd($b_ids);
         $m_al =  Branch::whereIn('id',$b_id)->get();
          $m_all =  Manager::where('user_id',Auth::user()->id)->get();
          $m =  Manager::all();
         return view('backend.loan.request-loan', compact('m_all','m_al','m'));

     } 
    
    public function manager_request(Request $request) 
    {
        $prefix = 'SYT';
         $random = random_int(100000000000000000, 999999999999999999);
        // shuffle($random);
        // $random = array_shift($random);
        $w = "LDS";
        $ln = $prefix.$random.$w;
        
        
         $m_request = new Manager();
         $m_request->disbusment_id = $ln;
         $m_request->locations = implode(",",$request->locations);
         $m_request->amount = $request->input('amount');
         $m_request->status = 0;
         $m_request->user_id = Auth::user()->id;
         //dd($m_request);
         $m_request->save();

         return back()->with('success', _lang('Request Submited'));

     }
     
     public function manager_repayment(Request $request) 
    {
        $prefix = 'SYT';
         $random = random_int(100000000000000000, 999999999999999999);
        // shuffle($random);
        // $random = array_shift($random);
        $w = "TRX";
        $ln = $prefix.$random.$w;
        
        
         $m_request = new MRepayment();
         $m_request->txid = $ln;
         $m_request->amount = $request->input('amount');
         $m_request->status = 0;
         $m_request->user_id = Auth::user()->id;
         //dd($m_request);
         $m_request->save();

         return back()->with('success', _lang('Repayment Submited'));

     }
     
     public function manager_repayments(Request $request) 
    {   
        $b_id = explode(",",Auth::user()->branch_id);
        //  $m =  Manager::whereIn('locations',$b_id)->pluck('locations');
        //  $b_ids = explode(",",$m);
        //  dd($b_ids);
         $m_al =  Branch::whereIn('id',$b_id)->get();
          $mn =  MRepayment::where('user_id',Auth::user()->id)->get();
        $mr = MRepayment::all();
       return view('backend.loan.manager_repayment', compact('mr','mn'));

     }
    
    public function managerEdit($id) 
    {
        $ma = Manager::find($id);
        $b_id = explode(",",Auth::user()->branch_id);
      
         $m_al =  Branch::whereIn('id',$b_id)->get();
         
         $get_branch_id_list = explode(",", $ma->locations);
        $locations = Branch::whereIn('id', $get_branch_id_list)->get();
         
        if ($ma->status == 1) {
            return back()->with('error', _lang('Sorry, Request has Been Approved'));
        if(Auth::user()->user_type == 'admin'){
            return view('backend.loan.manager_request_edit', compact('ma', 'id','m_al','locations'));
        }
        }else{
            return view('backend.loan.manager_request_edit', compact('ma', 'id','m_al','locations'));
        }

    }
    
    public function repaymentEdit($id) 
    {
        $ma = MRepayment::find($id);
        $b_id = explode(",",Auth::user()->branch_id);
      
         $m_al =  Branch::whereIn('id',$b_id)->get();
         
         $get_branch_id_list = explode(",", $ma->locations);
        $locations = Branch::whereIn('id', $get_branch_id_list)->get();
         
        if ($ma->status == 1) {
            return back()->with('error', _lang('Sorry, Repayment has Been Approved'));
        if(Auth::user()->user_type == 'admin'){
            return view('backend.loan.manager_repayment_edit', compact('ma', 'id','m_al','locations'));
        }
        }else{
            return view('backend.loan.manager_repayment_edit', compact('ma', 'id','m_al','locations'));
        }

    }

   public function managerUpdate(Request $request, $id)
   {
       
        
        $ma = Manager::find($id);
            $ma->amount = $request->input('amount');
            $loan->save();

            return redirect()->route('backend.loan.request-loan')->with('success', _lang('Updated successfully'));
       

     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function managerDestroy($id)
    {
        

        $m = Manager::find($id);
        $m->delete();

        return redirect()->route('loans.manager_request_view')->with('success', _lang('Deleted successfully'));
    }
    
    public function repayDestroy($id)
    {
        

        $m = MRepayment::find($id);
        $m->delete();

        return redirect()->route('loans.manager_repayment')->with('success', _lang('Deleted successfully'));
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::with(['loans', 'status'])
                ->where('status','=','2')
                ->orWhere('status','=', '0')
                ->get();
        return view('backend.loan.create', compact('users'));
    }
    
    public function search($status)
    {
        //
        
        $status = $request->input('search');
        $loans = Loan::query()
        ->where('status', 'LIKE', "%{$search}%")
        ->get();
        
        return view('backend.loan.list', compact('loans'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
   
                      
             $status = DB::table('loans')->where('borrower_id', $request->borrower_id)->where(function($query) {
			$query->where('status',  '0')
						->orWhere('status',  '1');
          })->get();



        //
        $prefix = 'SYT';
         $random = random_int(100000000000000000, 999999999999999999);
        // shuffle($random);
        // $random = array_shift($random);
        $w = "W";
        $ln = $prefix.$random.$w;
        //dd($ln);
        $request->validate([
            'loan_id'                => 'nullable|unique:loans',
             'loan_product_id'        => 'required',
             'borrower_id'            => 'required',
             'currency_id'            => 'nullable',
             'first_payment_date'     => 'nullable',
             'release_date'           => 'nullable',
             'applied_amount'         => 'required|numeric',
             'late_payment_penalties' => 'required|numeric',
             'attachment'             => 'nullable|mimes:jpeg,JPEG,png,PNG,jpg,doc,pdf,docx,zip',
        ]);
        
         $attachment = "";
         if ($request->hasfile('attachment')) {
             $file       = $request->file('attachment');
             $attachment = time() . $file->getClientOriginalName();
             $file->move(public_path() . "/uploads/media/", $attachment);
         }
        
        $dura = 7;
         $date = date("Y-m-d"); 
         //increment 2 days 
         $mod_date = strtotime($date.$dura. "day"); 
         $repayment_date =  date("Y-m-d",$mod_date);
         
         
         $loan                         = new Loan();
         $loan->loan_id                = $ln;
         $loan->loan_product_id        = $request->input('loan_product_id');
         $loan->borrower_id            = $request->input('borrower_id');
         $loan->branch_id            = $request->input('branch_id');
         $loan->currency_id            = '1';
         $loan->first_payment_date     = $repayment_date;
         $loan->release_date           = $request->input('release_date');
        $loan->duration            = $dura;
         $loan->applied_amount         = $request->input('applied_amount');
         $loan->late_payment_penalties = $request->input('late_payment_penalties');
         $loan->attachment             = $attachment;
         $loan->description            = $request->input('description');
         $loan->remarks                = $request->input('remarks');
         $loan->created_user_id        = Auth::id();

         
        
        // Create Loan Repayments
         $calculator = new Calculator(
             $loan->applied_amount,
             $loan->first_payment_date,
             $loan->loan_product->interest_rate,
             $loan->loan_product->term,
             $loan->loan_product->term_period,
             $loan->late_payment_penalties
         );

         if ($loan->loan_product->interest_type == 'flat_rate') {
             $repayments = $calculator->get_flat_rate();
         } else if ($loan->loan_product->interest_type == 'fixed_rate') {
             $repayments = $calculator->get_fixed_rate();
         } else if ($loan->loan_product->interest_type == 'mortgage') {
             $repayments = $calculator->get_mortgage();
         } else if ($loan->loan_product->interest_type == 'one_time') {
             $repayments = $calculator->get_one_time();
         }

         $loan->total_payable = $calculator->payable_amount;
         if(!$status->isEmpty()){
          
              return redirect()->route('loans.create')->with('danger', _lang('Active Loans Not yet Completed check back later'));
        //$create = Loan::create($request->all());
         }else{
         $loan->save();
        if (!$request->ajax()) {
             return redirect()->route('loans.show', $loan->id)->with('success', _lang('New Loan added successfully'));
         } else {
             return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('New Loan added successfully'), 'data' => $loan, 'table' => '#loans_table']);
         }
         }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
         $loan            = Loan::find($id);
         $loancollaterals = LoanCollateral::where('loan_id', $loan->id)
             ->orderBy("id", "asc")
             ->get();
         $repayments = Repayment::where('loan_id', $loan->id)
                        ->orderBy("id", "asc")
                        ->get();
        $repay            = Repayment::with('loans','user')
                                    ->where('loan_id', $loan->loan_id)
                                    ->orderBy("id", "asc")
                                    ->get();
        //dd($repay);
         $payments = LoanPayment::where('loan_id', $loan->id)->get();

         if (!$request->ajax()) {
             return view('backend.loan.view', compact('loan', 'loancollaterals', 'repayments', 'payments','repay'));
         } else {
             return view('backend.loan.modal.view', compact('loan', 'loancollaterals', 'repayments', 'payments','repay'));
         }

     }
    
    
    public function repayapproved(Request $request, $id)
    {
         $mr = MRepayment::find($id);
         
         //dd($mr);
             $mr->status           = 1;
             $mr->approved_date    = date('Y-m-d');
             $mr->approved_by_id = Auth::id();
             
             $mr->save();
            return back()->with('success', _lang('Repayment Successfuly'));
        
    }
    public function mapproval($id){
         $ma = Manager::find($id);
        
        
             $ma->status           = 1;
             $ma->approved_date    = date('Y-m-d');
             $ma->approved_user_id = Auth::id();
             $ma->save();
            return back()->with('success', _lang('Request Approved Successfuly'));
        
    }
    public function approve(Request $request, $id) 
    {
       
         
         
         
         DB::beginTransaction();

         $loan = Loan::find($id);
        
        //  if ($loan->status == 1) {
        //      abort(403);
        //  }

         if ($loan->loan_id == NULL || $loan->release_date == NULL) {
             return back()->with('error', _lang('Loan ID and Release date must required !'));
         }

         $loan->status           = 1;
         $loan->approved_date    = date('Y-m-d');
         $loan->approved_user_id = Auth::id();
         $loan->save();

         // Create Loan Repayments
         $calculator = new Calculator(
             $loan->applied_amount,
             $loan->getRawOriginal('first_payment_date'),
             $loan->loan_product->interest_rate,
             $loan->loan_product->term,
             $loan->loan_product->term_period,
             $loan->late_payment_penalties
         );

         if ($loan->loan_product->interest_type == 'flat_rate') {
             $repayments = $calculator->get_flat_rate();
         } else if ($loan->loan_product->interest_type == 'fixed_rate') {
             $repayments = $calculator->get_fixed_rate();
         } else if ($loan->loan_product->interest_type == 'mortgage') {
             $repayments = $calculator->get_mortgage();
         } else if ($loan->loan_product->interest_type == 'one_time') {
             $repayments = $calculator->get_one_time();
         }

         $loan->total_payable = $calculator->payable_amount;
         $loan->save();

         foreach ($repayments as $repayment) {
             $loan_repayment                   = new LoanRepayment();
             $loan_repayment->loan_id          = $loan->id;
             $loan_repayment->repayment_date   = $repayment['date'];
             $loan_repayment->amount_to_pay    = $repayment['amount_to_pay'];
             $loan_repayment->penalty          = $repayment['penalty'];
             $loan_repayment->principal_amount = $repayment['principle_amount'];
            $loan_repayment->interest         = $repayment['interest'];
             $loan_repayment->balance          = $repayment['balance'];
             $loan_repayment->save();
         }
         
         
         //Create Transaction
         $transaction                  = new Transaction();
         $transaction->user_id         = $loan->borrower_id;
         $transaction->currency_id     = $loan->currency_id;
         $transaction->amount          = $loan->applied_amount;
         $transaction->dr_cr           = 'cr';
         $transaction->type            = 'Loan';
         $transaction->method          = 'Manual';
         $transaction->status          = 2;
         $transaction->note            = 'Loan Approved';
         $transaction->loan_id         = $loan->id;
         $transaction->created_user_id = auth()->id();

         $transaction->save();

         DB::commit();

         try {
             $transaction->user->notify(new ApprovedLoanRequest($transaction));
         } catch (\Exception $e) {}
        // return redirect()->route('sort.pending')->with('success', _lang('Loan Request Approved'));
         return back()->with('success', _lang('Loan Request Approved'));
         //echo '<script>alert("Loan Request Approved")</script>';

     }
    public function mcompleted($id){
         $ma = Manager::find($id);
        
             $ma->status           = 2;
             $ma->approved_date    = date('Y-m-d');
             $ma->approved_user_id = Auth::id();
             $ma->save();
            return back()->with('success', _lang('Request Completed'));
        
    }
    
    public function completed(Request $request, $id){
        $loan = Loan::find($id);
       
        
        
        $loan->status = 2; //Completed
        $total_payable = Loan::find($id,'total_payable');
        //$pay = implode('', array_values($total_payable));
        if($loan->status = 2){
            $loan->total_paid = $loan->total_payable;
        }
        //dd($loan->total_payable);
        $loan->save();
        
        return back()->with('success', _lang('Loan Completed'));
    }
    
    public function paid(Request $request, $id){
        $repayment = LoanRepayment::find($id);
        $repayment->status = 4; //Paid
        $repayment->updated_by_id = auth()->user()->first_name.' '.auth()->user()->first_name;
        $repayment->save();
        return back()->with('success', _lang('Loan Paid'));
    }
    
    public function reject(Request $request, $id) {
        $loan = Loan::find($id);
        /** If not pending */
        if ($loan->status != 0) {
            abort(403);
        }
        $loan->status = 3; //Cancelled
        $loan->save();

        try {
            $loan->borrower->notify(new RejectLoanRequest($loan));
        } catch (\Exception $e) {}

         return redirect()->route('sort.pending')->with('success', _lang('Loan Request Rejected'));
    }
    
    public function disapproved(Request $request, $id) {
        
        
        $loan = Loan::find($id);

        $loan->status = 0; //disapproved
        $loan->save();
        
        
        
        $message = new AppNotification();
        $message -> message = 'Loan has been Disapproved';
        $message -> branch_id = $loan->branch_id;
        $message -> customer_id = $loan->borrower_id;
        $message -> status = '0';
        $message ->save();
        

         return redirect()->route('sort.pending')->with('success', _lang('Loan Request Disapproved'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) 
    {
        $loan = Loan::find($id);
        if ($loan->status == 2) {
            return back()->with('error', _lang('Sorry, This Loan is already completed'));
        }
        if (!$request->ajax()) {
            return view('backend.loan.edit', compact('loan', 'id'));
        } else {
            return view('backend.loan.modal.edit', compact('loan', 'id'));
        }

    }

   public function update(Request $request, $id)
   {
       if(Auth::user()->user_type == 'manager')
       {
           $ma = MRepayment::find($id);
            $ma->amount = $request->input('amount');
            $ma->save();

            return redirect()->route('loans.manager_repayment')->with('success', _lang('Updated successfully'));
       }
       if(Auth::user()->user_type == 'manager')
       {
           $mr = Manager::find($id);
            $mr->amount = $request->input('amount');
            $ma->save();

            return redirect()->route('loans.manager_repayment')->with('success', _lang('Updated successfully'));
       }
       
        $prefix = 'SYT';
        $random = random_int(100000, 999999);
        // shuffle($random);
        // $random = array_shift($random);
        $ln = $prefix.$random;
        
        @ini_set('max_execution_time', 0);
        @set_time_limit(0);

        $loan = Loan::find($id);
        if ($loan->status == 2) {
            return back()->with('error', _lang('Sorry, This Loan is already completed'));
        }
        if ($loan->status != 0) {
            $loan->description = $request->input('description');
            $loan->remarks     = $request->input('remarks');

            $loan->save();

            return redirect()->route('loans.index')->with('success', _lang('Updated successfully'));
        } else {
            $validator = Validator::make($request->all(), [
                'loan_id'                => [
                    'nullable',
                    Rule::unique('loans')->ignore($id),
                ],
                'loan_product_id'        => 'nullable',
                'borrower_id'            => 'nullable',
                'currency_id'            => 'nullable',
                'first_payment_date'     => 'nullable',
                'release_date'           => 'nullable',
                'status'           => 'nullable',
                'applied_amount'         => 'nullable|numeric',
                'late_payment_penalties' => 'nullable|numeric',
                'attachment'             => 'nullable|mimes:jpeg,JPEG,png,PNG,jpg,doc,pdf,docx,zip',
            ]);
        }

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('loans.edit', $id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        if ($request->hasfile('attachment')) {
            $file       = $request->file('attachment');
            $attachment = time() . $file->getClientOriginalName();
            $file->move(public_path() . "/uploads/media/", $attachment);
        }

        DB::beginTransaction();
        
        //$duration = LoanProduct::select('term_period');
        
        $start_date = $request->input('release_date');  
        $date = strtotime($start_date);
        $date = strtotime("+7 day.", $date);
        $repayment_date = date('Y/m/d', $date);

        $loan                         = Loan::find($id);
        $loan->loan_id                = $ln;
        $loan->loan_product_id        = $request->input('loan_product_id');
        $loan->borrower_id            = $request->input('borrower_id');
        $loan->currency_id            = $request->input('currency_id');
        $loan->first_payment_date     = $request->input('first_payment_date');
        $loan->release_date           = $request->input('release_date');
        $loan->applied_amount         = $request->input('applied_amount');
        $loan->late_payment_penalties = $request->input('late_payment_penalties');
        if ($request->hasfile('attachment')) {
            $loan->attachment = $attachment;
        }
        $loan->status = $request->input('status');
        $loan->description = $request->input('description');
        $loan->remarks     = $request->input('remarks');
        //dd($loan->save());
        //$loan->save();

        // Create Loan Repayments
        $calculator = new Calculator(
            $loan->applied_amount,
            $loan->first_payment_date,
            $loan->loan_product->interest_rate,
            $loan->loan_product->term,
            $loan->loan_product->term_period,
            $loan->late_payment_penalties
        );

        if ($loan->loan_product->interest_type == 'flat_rate') {
            $repayments = $calculator->get_flat_rate();
        } else if ($loan->loan_product->interest_type == 'fixed_rate') {
            $repayments = $calculator->get_fixed_rate();
        } else if ($loan->loan_product->interest_type == 'mortgage') {
            $repayments = $calculator->get_mortgage();
        } else if ($loan->loan_product->interest_type == 'one_time') {
            $repayments = $calculator->get_one_time();
        }

        $loan->total_payable = $calculator->payable_amount;
        $loan->save();

        DB::commit();

        if (!$request->ajax()) {
            return redirect()->route('loans.index')->with('success', _lang('Updated successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated successfully'), 'data' => $loan, 'table' => '#loans_table']);
        }

    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        $loan = Loan::find($id);

        $loancollaterals = LoanCollateral::where('loan_id', $loan->id);
        $loancollaterals->delete();

        $repayments = LoanRepayment::where('loan_id', $loan->id);
        $repayments->delete();

        $loanpayment = LoanPayment::where('loan_id', $loan->id);
        $loanpayment->delete();

        $transaction = Transaction::where('loan_id', $loan->id);
        $transaction->delete();

        $loan->delete();

        DB::commit();

        return redirect()->route('loans.index')->with('success', _lang('Deleted successfully'));
    }

    public function calculator() {
        $data                           = array();
        $data['first_payment_date']     = '';
        $data['apply_amount']           = '';
        $data['interest_rate']          = '';
        $data['interest_type']          = '';
        $data['term']                   = '';
        $data['term_period']            = '';
        $data['late_payment_penalties'] = 0;
        return view('backend.loan.calculator', $data);
    }

    public function calculate(Request $request) {
        $validator = Validator::make($request->all(), [
            'apply_amount'           => 'required|numeric',
            'interest_rate'          => 'required',
            'interest_type'          => 'required',
            'term'                   => 'required|integer|max:100',
            'term_period'            => $request->interest_type == 'one_time' ? '' : 'required',
            'late_payment_penalties' => 'required',
            'first_payment_date'     => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('loans.calculator')->withErrors($validator)->withInput();
            }
        }

        $first_payment_date     = $request->first_payment_date;
        $apply_amount           = $request->apply_amount;
        $interest_rate          = $request->interest_rate;
        $interest_type          = $request->interest_type;
        $term                   = $request->term;
        $term_period            = $request->term_period;
        $late_payment_penalties = $request->late_payment_penalties;

        $data       = array();
        $table_data = array();

        if ($interest_type == 'flat_rate') {

            $calculator             = new Calculator($apply_amount, $first_payment_date, $interest_rate, $term, $term_period, $late_payment_penalties);
            $table_data             = $calculator->get_flat_rate();
            $data['payable_amount'] = $calculator->payable_amount;

        } else if ($interest_type == 'fixed_rate') {

            $calculator             = new Calculator($apply_amount, $first_payment_date, $interest_rate, $term, $term_period, $late_payment_penalties);
            $table_data             = $calculator->get_fixed_rate();
            $data['payable_amount'] = $calculator->payable_amount;

        } else if ($interest_type == 'mortgage') {

            $calculator             = new Calculator($apply_amount, $first_payment_date, $interest_rate, $term, $term_period, $late_payment_penalties);
            $table_data             = $calculator->get_mortgage();
            $data['payable_amount'] = $calculator->payable_amount;

        } else if ($interest_type == 'one_time') {

            $calculator             = new Calculator($apply_amount, $first_payment_date, $interest_rate, 1, $term_period, $late_payment_penalties);
            $table_data             = $calculator->get_one_time();
            $data['payable_amount'] = $calculator->payable_amount;

        }

        $data['table_data']             = $table_data;
        $data['first_payment_date']     = $request->first_payment_date;
        $data['apply_amount']           = $request->apply_amount;
        $data['interest_rate']          = $request->interest_rate;
        $data['interest_type']          = $request->interest_type;
        $data['term']                   = $request->term;
        $data['term_period']            = $request->term_period;
        $data['late_payment_penalties'] = $request->late_payment_penalties;

        return view('backend.loan.calculator', $data);

    }
}

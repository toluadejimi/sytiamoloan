<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoanProduct;
use App\Models\Loan;
use App\Models\User;
use App\Models\LoanRepayment;
use Illuminate\Http\Response;
use Carbon\Carbon;
use App\Utilities\LoanCalculator as Calculator;
use DB;
use Auth;

class LoanProductApiController extends Controller
{

    public $successStatus = true;
    public $failedStatus = false;
    public $failed = 'Active Loans Not yet Completed';
    public $loancreation = 'You have an active loan';
    //
    public function loanproduct()
    {
        $loanproduct = LoanProduct::all();
        if ($this->successStatus == true) {
            return response()->json(["status" => $this->successStatus, "data" => $loanproduct])
    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        }else{
            return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
        }
    }

    public function loans()
    {
        $loan = Loan::all();
        if ($this->successStatus == true) {
            return response()->json(["status" => $this->successStatus, "data" => $loan])
    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        }else{
            return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
        }
    }

    public function createloan(Request $request)
    {
    
                      
    $status = DB::table('loans')->where('borrower_id', $request->borrower_id)->where(function($query) {
			$query->where('status',  '0')
						->orWhere('status',  '1');
})->get();
                      
            //           if(!$status->isEmpty()){
            
            // return response()->json(["data" => $this->loancreation,'error' => 'Unauthorised'], 401);}
                      
                //  return response()->json(["data" => $status, "'status" => $status->isEmpty()]);
        $request->validate([
            'loan_id'                => 'nullable|unique:loans',
            'loan_product_id'        => 'nullable',
            'borrower_id'            => 'required',
            'currency_id'            => 'nullable',
            'first_payment_date'     => 'nullable',
            'release_date'           => 'nullable',
            'applied_amount'         => 'required|numeric',
            'late_payment_penalties' => 'required|numeric',
            'attachment'             => 'nullable|mimes:jpeg,JPEG,png,PNG,jpg,doc,pdf,docx,zip',
        ]);
        
        $dura = $request->input('duration');
         $date = date("Y-m-d"); 
         //increment 2 days 
         $mod_date = strtotime($date.$dura. "day"); 
         $repayment_date =  date("Y-m-d",$mod_date);
         
           $prefix = 'SYT';
        $random = random_int(100000000000000000, 999999999999999999);
        // shuffle($random);
        // $random = array_shift($random);
        $m = "M";
        $ln = $prefix.$random.$m;
         
         //$date = Carbon::now();
         $date = date("Y-m-d");
         
          $attachment = "";
         if ($request->hasfile('attachment')) {
             $file       = $request->file('attachment');
             $attachment = time() . $file->getClientOriginalName();
             $file->move(public_path() . "/uploads/media/", $attachment);
         }
         
         $user = User::where('id',$request->borrower_id)
                    ->get();
         
        if(!$status->isEmpty()){
            
            return response()->json(["data" => $this->loancreation,'error' => 'Unauthorised'], 401);
        }else{
             $loan                         = new Loan();
              $loan->loan_id                = $ln;
            $loan->loan_product_id        = $request->input('loan_product_id');
         $loan->borrower_id            = $request->input('borrower_id');
         $loan->branch_id            = $request->input('branch_id');
         $loan->currency_id            = '1';
         $loan->first_payment_date     = $repayment_date;
         $loan->release_date           = $date;
         $loan->duration            = $dura;
         $loan->applied_amount         = $request->input('applied_amount');
         $loan->late_payment_penalties = $request->input('late_payment_penalties');
         $loan->attachment             = $attachment;
         $loan->description            = $request->input('description');
         $loan->remarks                = $request->input('remarks');
         $loan->created_user_id        =  $request->input('created_user_id');
        //$create = Loan::create($request->all());
        
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

        if ($this->successStatus == true) {
            return response()->json(["status" => $this->successStatus, "data" => $loan, "user" => $user])
    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        }else{
            return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
        }
        }
    }


    
    public function breakdown(Request $request)
    {
            $loan_repayments = DB::table('loan_repayments')->where('loan_id', $request->loan_id)->get();
            

         if ($this->successStatus == true) {
            return response()->json(["status" => $this->successStatus, "data" => $loan_repayments])
    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        }else{
            return response()->json(["status" => $this->failedStatus,'error' => 'fail to fetch'], 401);
        }
        
    }





    
}

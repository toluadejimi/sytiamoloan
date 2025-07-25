<?php

namespace App\Http\Controllers\Apis;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoanRepayment;
use App\Models\Repayment;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Response;
use DB;
use Illuminate\Support\Facades\Hash;
use Mail;

class LoanrepaymentApiController extends Controller
{
    public $successStatus = true;
    public $failedStatus = false;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $repay = LoanRepayment::all();
        if ($this->successStatus == true) {
            return response()->json(["status" => $this->successStatus, "data" => $repay])
    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        }else{
            return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
        }

    }
    
    
    public function loancollect(Request $request)
    {
        //
        
        $user_id = $request->created_user_id;
        $location = $request->branch_id;
        $loancollection = Loan::with([
            'user','borrower',
            ])->where('branch_id', '=', $location)
                              ->where('status', '=', '1')
                              ->where('created_user_id', '=', $user_id)
                              ->get();
         $user = User::where('id',$request->borrower_id)
                    ->get();
        
        if ($this->successStatus == true) {
            return response()->json(["status" => $this->successStatus, "data" => $loancollection])
    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        }else{
            return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
        }
    

    }
    
     public function loancollect_by_id(Request $request, $loan_id)
    {
        //
        
        $user_id = $request->created_user_id;
        $location = $request->branch_id;
        
        $loancollection = Loan::with([
            'user','borrower','repayments',
            ])->where('created_user_id','=',$user_id)
                              ->where('branch_id', '=', $location)
                              ->where('status', '=', '0')
                              ->where('status', '=', '4')
                              ->orWhere('status', '=', '1')
                              ->get();
         $user = User::where('id',$request->borrower_id)
                    ->get();
        
        if ($this->successStatus == true) {
            return response()->json(["status" => $this->successStatus, "data" => $loancollection])
    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        }else{
            return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
        }
    

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     
    public function paid(Request $request, $id){
        $loan =  LoanRepayment::find($id);
        $loan->status = 4;
        $loan->updated_by_id = $request->input('updated_by_id');  //Paid
        
        $loan->save();
        
       if ($this->successStatus == true) {
            return response()->json(["status" => $this->successStatus, "data" => $loan])
    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        }else{
            return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
        }
    }
    
    public function report(Request $request) {
 
        //$reports = Loan::all();
        $from = date($request->datefrom);
        $to = Carbon::parse($request->dateto)->endOfDay();
        $user_id = $request->created_user_id;
        //$users = User::all();
        
        $sum = 0;
        // $reports = Loan::with([
        //     'user','borrower'
        //     ])
        //     ->where('created_user_id','=',$user_id)
        //     ->whereBetween('created_at',[$from, $to])
        //     ->get();
        $reports = Loan::with(['user','borrower'])
                            ->where('created_user_id',$request->created_user_id)
                            ->where('created_at','>=',$from)
                            ->where('created_at','<=',$to)->get();
    
        //  $user = User::where('id',$request->borrower_id)
        //             ->get();
        
         if ($this->successStatus == true) {
            return response()->json(["status" => $this->successStatus, "data" => $reports])
                    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        }else{
            return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
        }
    }
    public function create()
    {
        //
         
         
         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createrepay(Request $request)
    { 
        
        $borrower = User::where('id', $request->input('borrower_id'))->first();
        //dd($borrower);
        
        $user = User::where('id', $request->input('agent_id'))->first();//Agent detials
        
        
        
        $to = "ebukamiracle35@gmail.com";
        $subject = "You have a new Message on Completed Loan";
        $txt = "A New message on Completed Loan " ."\r\n\n".
        "Borrower Name -> ".$borrower->first_name. " ".$borrower->middle_name."\r\n" .
        "Loan ID -> ".$request->input('loan_id'). " " ."\r\n" .
        "Submitted by -> " .$user->first_name. " "."\r\n\n" . 
        "Check dashboard to verify";   
        $headers = "From: noreply@sytiamoportal.com" . "\r\n" .
        "CC: toluadejimi@gmail.com";
        
    
                
                

        
        
        $user = User::where('id', $request->input('agent_id'))->first();
        $hashedPassword = $user->password; 
        if (!Hash::check($request->input('agent_password'), $hashedPassword)) {
            return response()->json(["status" => $this->failedStatus,'message' => 'Agent Not Authenticated'], 401);
        }
        
        
        $balance = Loan::where('loan_id',$request->input('loan_id'))->first();
        
        //dd($balance->applied_amount);
        
        $amountToRecieve =  $balance->total_paid + $request->input('amount');
        
        if( $amountToRecieve <= $balance->applied_amount  ){
           
        
        //dd($balance);
         $repay                          = new Repayment();
         $repay->loan_id                = $request->input('loan_id');
         $repay->loan_product_id        = $request->input('loan_product_id');
         $repay->borrower_id            = $request->input('borrower_id');
         $repay->branch_id            = $request->input('branch_id');
         $repay->agent_id            = $request->input('agent_id');
         $repay->total_paid            = $request->input('amount');
         $repay->balance            = $balance->applied_amount - $amountToRecieve;
         $repay->status            = 4;
         
         
         $id   = $balance->id;
          $loan                          = Loan::find($id);
         $loan->total_paid                = $amountToRecieve;
        $loan->save();
         $repayments = $repay->save();
          
          if($amountToRecieve == $balance->applied_amount ){ 
              
              mail($to,$subject,$txt,$headers);
              
          }
          
          return response()->json(["status" => $this->successStatus,'data'=> $repayments, 'message' => 'Payment Successful'], 200);

        }else{
            return response()->json(["status" => $this->failedStatus,'message' => 'Loan has exceeded applied amount'], 401);
        }
          
         // -------------------------------------------------------------------------------------------------------------------------------

        
        
    //   if ($this->successStatus == true) {
    //         return response()->json(["status" => $this->successStatus, "data" => $repayments])
    // ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
    //     }else{
    //         return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
    //     }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function loandetails(Request $request)
    {
        
       
       $location = $request->input('branch_id');
        $loan_id = $request->input('loan_id');
        $user_id = $request->input('user_id');
        $id = $request->input('loan_product_id');
        $loandetails2 = Repayment::where('loan_id','=',$loan_id)->get();
        $loandetails = Loan::with('borrower','branch')->where('loan_id','=',$loan_id)->get();
       
       
        if ($this->successStatus == true) {
           	 return response()->json(["status" => $this->successStatus, "data" => collect([ 'loandetails' => $loandetails,'repayment'=>$loandetails2])],200)
    		->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        }else{
      		   return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    //     $repay = LoanRepayment::find($id);
    //     $repay->update($request->all());
    //     return $repay;
    //     if ($this->successStatus == true) {
    //         return response()->json(["status" => $this->successStatus, "data" => $repay])
    // ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
    //     }else{
    //         return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
    //     }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

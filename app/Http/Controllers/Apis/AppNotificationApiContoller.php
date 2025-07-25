<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoanProduct;
use App\Models\Loan;
use App\Models\User;
use App\Models\AppNotification;
use Illuminate\Http\Response;
use Carbon\Carbon;
use App\Utilities\LoanCalculator as Calculator;
use DB;
use Auth;

class AppNotificationApiContoller extends Controller
{
    public $successStatus = true;
    public $failedStatus = false;
    
    
 public function index()
    {
        $message = AppNotification::all();
        
        if ($this->successStatus == true) {
            return response()->json(["status" => $this->successStatus, 'data'=> $message])
    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        }else{
            return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
        }
    }
    
    
    public function messageBylocation(Request $request)
    {
        //
        $branch_id = $request->branch_id;
        
        
        //dd($request);
        $location = AppNotification::where('branch_id', 'LIKE', '%'.$branch_id.'%')->get();
        $count = AppNotification::where('branch_id',$branch_id)->where('status',0)->get()->count();

        
        
        
        if ($this->successStatus == true) {
            return response()->json(["status" => $this->successStatus, 'data'=> $location, "unread"=>$count])
    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        }else{
            return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
        }
    }
    
     public function updateMessage(Request $request)
    {
        
        $message_id = $request->id;
        //dd($request);
        $message = AppNotification::find($message_id);
       
        $message->status = 1; 
        $message->save();
        
        
        if ($this->successStatus == true) {
            return response()->json(["status" => $this->successStatus, 'data'=> $message])
    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        }else{
            return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
        }
        
    {
    

    
}
}
    
}
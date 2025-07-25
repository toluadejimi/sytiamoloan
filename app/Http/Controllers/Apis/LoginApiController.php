<?php

namespace App\Http\Controllers\Apis;
//namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Response;


class LoginApiController extends Controller
{
    public $successStatus = true;
    public $failedStatus = false;

    public function login()
    {
        
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')]))
        {
            $user = Auth::user();
            //$success ['token'] = $user->createToken('MyApp')->accessToken;
            //return response()->json(['success'=> $success, "user"=>$user], $this->successStatus);
            $get_branch_id_list = explode(",", $user->branch_id);
        $locations = Branch::whereIn('id', $get_branch_id_list)->get();
            return response()->json(["status" => $this->successStatus, "user"=>$user, 'locations' => $locations])
    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        }else{
            return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
        }
    }
}

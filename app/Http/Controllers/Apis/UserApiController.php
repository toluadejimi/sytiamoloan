<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Exception;
use PDOException;
use GuzzleHttp\Client as GuzzleClient;



class UserApiController extends Controller
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
        $user = User::all();
        
        if ($this->successStatus == true) {
            return response()->json(["status" => $this->successStatus, 'data'=> $user])
    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        }else{
            return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
        }
    }
    
    public function userBylocation(Request $request)
    {
        //
        $location_id = $request->location_id;
        // dd($request);
        $user = User::with('branch')->where('branch_id',$location_id)->where('user_type','customer')->get();
        
        
        if ($this->successStatus == true) {
            return response()->json(["status" => $this->successStatus, 'data'=> $user])
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
    public function store(Request $request)
    {

        //
        $request->validate([
            'first_name'            => 'required|max:255',
            'middle_name'           => 'nullable|max:255',
            'last_name'           => 'required|max:255',
            'email'           => 'nullable',
            'branch_id'       => 'required',
            'status'          => 'required',
            'profile_picture' => 'nullable|image',
            //'password'        => 'nullable|min:6',
        ]);
        
        try{
            
        
         $create = new User();
         $create->first_name  = $request->input('first_name');
         $create->middle_name  = $request->input('middle_name');
         $create->last_name  = $request->input('last_name');
         $create->email  = $request->input('email');
         $create->phone  = $request->input('phone');
         $create->bvn  = $request->input('bvn');
         $create->account_number  = $request->input('account_number');
         $create->bank_code  = $request->input('bank_code');
         $create->acc_name  = $request->input('acc_name');
         $create->bank_name  = $request->input('bank_name');
         $create->address  = $request->input('address');
         $create->gender  = $request->input('gender');
         $create->user_type  = $request->input('user_type');
         $create->status  = $request->input('status');
         $create->branch_id  = $request->input('branch_id');
           $create->dob  = $request->input('dob');
        if($file = $request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'uploads/media' ;
            $request->profile_picture->move(public_path('uploads/media'),$fileName);
            $create->profile_picture = $fileName ;
        }
        
        if($file = $request->hasFile('gpicture')) {
            $file = $request->file('gpicture') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'uploads/media' ;
            $request->gpicture->move(public_path('uploads/media'),$fileName);
            $create->gpicture = $fileName ;
        }
       
       
       
       
        $create->sbus_stop              = $request->input('sbus_stop');
        $create->hbus_stop              = $request->input('hbus_stop');
        $create->gbus_stop              = $request->input('gbus_stop');
        $create->g2bus_stop             = $request->input('g2bus_stop');
        $create->gname  = $request->input('gname');
        $create->gphone  = $request->input('gphone');
        $create->gaddress  = $request->input('gaddress');
        $create->gbus_stop  = $request->input('gbus_stop');
        $create->gname2  = $request->input('gname2');
        $create->gaddress2  = $request->input('gaddress2');
        $create->g2bus_stop  = $request->input('g2bus_stop');
        
        $users = $create->save() ;
        //$create = User::create($request->all());
        ///dd($users)
        if ($this->successStatus == true) {
            return response()->json(["status" => $this->successStatus, 'data'=> $users])
    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        }else{
            return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
        }
        
        
        
        }catch(Exception $e){
            
            if($e instanceof PDOException)
        {
            return response()->json(["status" => $this->failedStatus,'error' => 'Customer Already Exist'], 401);
        }
        
            return response($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $user = User::find($id);
        $user->update($request->all());
        //return $user;
        if ($this->successStatus == true) {
            return response()->json(["status" => $this->successStatus, 'data' => $user])
    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        }else{
            return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function updateDob(Request $request, $id)
    {
        

        try{
            
        
        $id =  $request-> id;
        $dob = $request->dob;
        $bvn = $request->bvn;
        $nin = $request->nin;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $middle_name = $request->middle_name;
        $phone = $request->phone;
        $account_number  = $request->account_number;
        $bank_code  = $request->bank_code;
        $acc_name  = $request->acc_name;
        


        
        $update_detals = User::where('id', $id)
        ->update([
            
            'dob' => $dob,
            'bvn' => $bvn,
            'nin' => $nin,
            'first_name' =>$first_name,
            'last_name' => $last_name,
            'middle_name' => $middle_name,
            'phone' => $phone,

            ]);
        
        
        
        
        
        //return $user;
        if ($this->successStatus == true) {
            return response()->json(["status" => $this->successStatus, 'message' => 'Customer Updated Successsfully'])
    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        }else{
            return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
        }
    
    
    }catch( \Exception $e ){
            
            return $e->getMessage();
            
        }
        
    }
    
    public function destroy($id)
    {
        //
        return User::destroy($id);
    }
    public function search($name)
    {
        //
        $user = User::where('first_name', 'like', '%'.$name.'%')
                            ->where('user_type','customer')
                            ->get();
        //$user = User::where('first_name', '=',$request->name)->get();
        return response()->json(["status" => $this->successStatus, 'data' => $user]);
    }
    
    
    
    public function get_list_of_banks(){
        
        
        try{
            

        // $curl = curl_init();
        
        // curl_setopt_array($curl, array(
        //   CURLOPT_URL => '',
        //   CURLOPT_RETURNTRANSFER => true,
        //   CURLOPT_ENCODING => '',
        //   CURLOPT_MAXREDIRS => 10,
        //   CURLOPT_TIMEOUT => 0,
        //   CURLOPT_FOLLOWLOCATION => true,
        //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //   CURLOPT_CUSTOMREQUEST => 'GET',
        //   CURLOPT_HTTPHEADER => array(
        //     '',
        //     ': '
        //   ),
        // ));
        
            
        // $var = curl_exec($curl);
        // dd($var);

        // curl_close($curl);

        // $var = json_decode($var);
                    
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.flutterwave.com/v3/banks/NG',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_POSTFIELDS => 'email=admin%40admin.com&password=123456',
          CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Bearer FLWSECK-043cf4e9dd848683c6b157c234ba2fb8-X'
          ),
        ));
        
        $var = curl_exec($curl);

        curl_close($curl);

        $var = json_decode($var);


        $status = $var->status ?? null;
        

        


        if($status == 'success'){ 
            
            return response()->json([
                
                'status' => $this->successStatus,
                'banks' => $var,
                
                ], 200);
                
            }
            
            
            return response()->json([
                
                'status' => $this->failedStatus,
                'message' => 'Unable to get banks at the moment',
                
                ], 500);
                
            
            
            
            
            
                
                
        }catch( \Exception $e ){
            
            return $e->getMessage();
            
        }
        
        
                


    }
    
    
    
    
    
    
    
    public function account_verification(Request $request){
        
        
        $account_number = $request->account_number;
        $bank_code = $request->bank_code;
        
        try{
            
             $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer FLWSECK-043cf4e9dd848683c6b157c234ba2fb8-X',
            ];
        
            $client = new GuzzleClient([
                'headers' => $headers,
            ]);
        
            
            $response = $client->request('POST', 'https://api.flutterwave.com/v3/accounts/resolve', 
            [
                  'body' => json_encode([
                       "account_number" => $account_number,
                        "account_bank" => $bank_code,
            ]),
            
            ]);

            $body = $response->getBody();
            $result = json_decode($body);
            
            
            
            $acc_name = $result->data->account_name ?? null;
            

            

            if ($result->status == 'success') {
                
                  
                 return response()->json([
                
                'status' => $this->successStatus,
                'acc_name' => $acc_name,
                
                ], 200);
                
            }
            
            if($result->status == 'error'){
            
            
             return response()->json([
                
                'status' => $this->failedStatus,
                'message' => 'Check account number or bank for errors',
                
                ], 500);
                
            }
            
        }catch( \Exception $e){
            
            return $e->getMessage();
            
            
        }
        
    }
        
        
    public function update_bank(Request $request){
        
        
        $id = $request->id;
        $account_number = $request->account_number;
        $acc_name = $request->acc_name;
        $bank_name = $request->bank_name;
        
        
        try{
            
        $user = User::find($id);
        $user->account_number  = $request->input('account_number');
        $user->bank_code  = $request->input('bank_code');
        $user->acc_name  = $request->input('acc_name');
        $user->bank_name  = $request->input('bank_name');
        $user->save();
        
        
        //return $user;
        if ($this->successStatus == true) {
            return response()->json(["status" => $this->successStatus, 'data' => $user])
    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        }else{
            return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 500);
        }
            
            
            
        }catch( \Exception $e){
            
            return $e->getMessage();
            
            
        }
        
        
        
        
    }
        
         
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    


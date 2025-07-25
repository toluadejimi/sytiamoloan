<?php

namespace App\Http\Controllers;

use App\Mail\GeneralMail;
use App\Models\User;
use App\Models\Branch;
use App\Utilities\Overrider;
use DataTables;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Twilio\Rest\Client;
use Auth;
use Illuminate\Support\Arr;
use Exception;

class UserController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        date_default_timezone_set(get_option('timezone', 'Asia/Dhaka'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status = 'all') {
        try{
            $users = User::where('user_type','customer')->get();
        $b_id = explode(',',Auth::user()->branch_id);
        $manager = User::where('branch_id',$b_id)->where('user_type','customer')->get();
        //dd($manager,$b_id);
        return view('backend.user.list', compact('status','users','manager'));
            
        }catch(Exception $e){
         return $e;   
        }
        
    }
    
    
     public function exports($status = 'all') { 
        $users = User::where('user_type','customer')
        ->orderBy('dob', 'asc')
        ->get();
        $b_id = explode(',',Auth::user()->branch_id);
        $manager = User::where('branch_id',$b_id)->where('user_type','customer')->get();
        //dd($manager,$b_id);
        return view('backend.user.export', compact('status','users','manager'));
    }

   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        if (!$request->ajax()) {
            return view('backend.user.create');
        } else {
            return view('backend.user.modal.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        // $url = 'https://api.paystack.co/bank/resolve_bvn/'.$user->bvn;

        //   $ch = curl_init();
        //   curl_setopt($ch, CURLOPT_URL, $url);
        //   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //   curl_setopt(
        //     $ch, CURLOPT_HTTPHEADER, [
        //       'Authorization: Bearer sk_test_da5d641bf00am6413a188c2b383c4b263823e195a5'
        //     ]
        //   );
        //   $request = curl_exec($ch);
        //   curl_close($ch);

        //   if ($request) {
        //     $result = json_decode($request, true);
        //     return $result;
        //   }


        $validator = Validator::make($request->all(), [
            'first_name'            => 'required|max:255',
            'middle_name'           => 'nullable|max:255',
            'last_name'           => 'required|max:255',
            'email'           => 'nullable|email|unique:users|max:255',
            'branch_id'       => 'required',
            'status'          => 'required',
            'profile_picture' => 'nullable|image',
            'password'        => 'nullable|min:6',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('users.create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        // $profile_picture = "";
        // if ($request->hasfile('profile_picture')) {
        //     $file            = $request->file('profile_picture');
        //     $profile_picture = time() . $file->getClientOriginalName();
        //     $file->move(public_path() . "/uploads/profile/", $profile_picture);
        // }
        $profile_picture = "";
        if($request->file('profile_picture')){
            $file= $request->file('profile_picture');
            $profile_picture= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('/uploads/media/'), $profile_picture);
            $data['profile_picture']= $profile_picture;
        }
        
        // $gpicture = "";
        // if ($request->hasfile('gpicture')) {
        //     $file            = $request->file('gpicture');
        //     $gpicture = time() . $file->getClientOriginalName();
        //     $file->move(public_path() . "/uploads/profile/", $gpicture);
        // }
        
        $gpicture = "";
        if($request->file('gpicture')){
            $file= $request->file('gpicture');
            $gpicture= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('/uploads/media/'), $gpicture);
            $data['gpicture']= $gpicture;
        }

        // $nimc_front = "";
        // if ($request->hasfile('nimc_front')) {
        //     $file            = $request->file('nimc_front');
        //     $nimc_front = time() . $file->getClientOriginalName();
        //     $file->move(public_path() . "/uploads/profile/", $nimc_front);
        // }

        // $nimc_back = "";
        // if ($request->hasfile('nimc_back')) {
        //     $file            = $request->file('nimc_back');
        //     $nimc_back = time() . $file->getClientOriginalName();
        //     $file->move(public_path() . "/uploads/profile/", $nimc_back);
        // }

        $user                    = new User();
        $user->first_name              = $request->input('first_name');
        $user->middle_name              = $request->input('middle_name');
        $user->last_name              = $request->input('last_name');
        $user->email             = $request->input('email');
        //$user->country_code      = $request->input('country_code');
        $user->phone             = $request->input('phone');
        $user->bvn             = $request->input('bvn');
        $user->nin             = $request->input('nin');
        $user->address             = $request->input('address');
        $user->hbus_stop             = $request->input('hbus_stop');
        $user->shop_address             = $request->input('shop_address');
        $user->sbus_stop             = $request->input('sbus_stop');
        $user->dob             = $request->input('dob');
        $user->gender             = $request->input('gender');
        $user->user_type         = 'customer';
        $user->branch_id         = $request->branch_id;
        $user->status            = $request->input('status');
        $user->gname             = $request->input('gname');
        $user->gphone             = $request->input('gphone');
        $user->gaddress             = $request->input('gaddress');
        $user->gbus_stop             = $request->input('gbus_stop');
        $user->gname2            = $request->input('gname2');
        $user->gphone2             = $request->input('gphone2');
        $user->gaddress2             = $request->input('gaddress2');
        $user->g2bus_stop             = $request->input('g2bus_stop');
        // $user->nimc_front   = $nimc_front;
        // $user->nimc_back   = $nimc_back;
        
        
        $user->profile_picture   = $profile_picture;
        $user->gpicture   = $gpicture;
        $user->email_verified_at = $request->email_verified_at;
        $user->sms_verified_at   = $request->sms_verified_at;
        //$user->password          = Hash::make($request->password);

        $user->save();

        //Prefix Output
        $user->status          = status($user->status);
        $user->branch_id       = $user->branch->name;

        // $user->nimc_front = '<img src="' . nimc_front($user->nimc_front) . '" class="thumb-sm img-thumbnail">';
        // $user->nimc_back = '<img src="' . nimc_back($user->nimc_back) . '" class="thumb-sm img-thumbnail">';
        $user->profile_picture = '<img src="' . profile_picture($user->profile_picture) . '" class="thumb-sm img-thumbnail">';

        if (!$request->ajax()) {
            return redirect()->route('users.create')->with('success', _lang('Saved successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved successfully'), 'data' => $user, 'table' => '#users_table']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        $user = User::find($id);
        if (!$request->ajax()) {
            return view('backend.user.view', compact('user', 'id'));
        } else {
            return view('backend.user.modal.view', compact('user', 'id'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $user = User::find($id);
        if (!$request->ajax()) {
            return view('backend.user.edit', compact('user', 'id'));
        } else {
            return view('backend.user.modal.edit', compact('user', 'id'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'first_name'            => 'required|max:255',
            'middle_name'           => 'nullable|max:255',
            'last_name'           => 'required|max:255',
            'status'          => 'required',
            'branch_id'       => 'required',
            'profile_picture' => 'nullable|image',
            'password'        => 'nullable|min:6',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('users.edit', $id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        if ($request->hasfile('profile_picture')) {
            $file            = $request->file('profile_picture');
            $profile_picture = time() . $file->getClientOriginalName();
            $file->move(public_path() . "/uploads/profile/", $profile_picture);
        }

        $user               = User::find($id);
        $user->first_name              = $request->input('first_name');
        $user->middle_name              = $request->input('middle_name');
        $user->last_name              = $request->input('last_name');
        $user->country_code = $request->input('country_code');
        $user->phone        = $request->input('phone');
        $user->bvn             = $request->input('bvn');
        $user->nin             = $request->input('nin');
        $user->address             = $request->input('address');
        $user->hbus_stop             = $request->input('hbus_stop');
        $user->shop_address             = $request->input('shop_address');
        $user->sbus_stop             = $request->input('sbus_stop');
        $user->status       = $request->input('status');
        $user->branch_id    = $request->branch_id;
        $user->gname             = $request->input('gname');
        $user->gphone             = $request->input('gphone');
        $user->gaddress             = $request->input('gaddress');
        $user->gbus_stop             = $request->input('gbus_stop');
        $user->gname2            = $request->input('gname2');
        $user->gphone2             = $request->input('gphone2');
        $user->gaddress2             = $request->input('gaddress2');
        $user->g2bus_stop             = $request->input('g2bus_stop');
        if ($request->hasfile('profile_picture')) {
            $user->profile_picture = $profile_picture;
        }
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->email_verified_at = $request->email_verified_at;
        $user->sms_verified_at   = $request->sms_verified_at;

        $user->save();

        //Prefix Output
        $user->status          = status($user->status);
        $user->branch_id       = $user->branch->name;
        $user->profile_picture = '<img src="' . profile_picture($user->profile_picture) . '" class="thumb-sm img-thumbnail">';

        if (!$request->ajax()) {
            return redirect()->route('users.index')->with('success', _lang('Updated successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated successfully'), 'data' => $user, 'table' => '#users_table']);
        }

    }

    public function send_email(Request $request) {
        @ini_set('max_execution_time', 0);
        @set_time_limit(0);

        Overrider::load("Settings");

        $validator = Validator::make($request->all(), [
            'user_email' => 'required',
            'subject'    => 'required',
            'message'    => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return back()->withErrors($validator)
                    ->withInput();
            }
        }

        //Send email
        $subject = $request->input("subject");
        $message = $request->input("message");

        $mail          = new \stdClass();
        $mail->subject = $subject;
        $mail->body    = $message;

        try {
            Mail::to($request->user_email)
                ->send(new GeneralMail($mail));
        } catch (\Exception $e) {
            if (!$request->ajax()) {
                return back()->with('error', _lang('Sorry, Error Occured !'));
            } else {
                return response()->json(['result' => 'error', 'message' => _lang('Sorry, Error Occured !')]);
            }
        }

        if (!$request->ajax()) {
            return back()->with('success', _lang('Email Send Sucessfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Email Send Sucessfully'), 'data' => $contact]);
        }
    }

    public function send_sms(Request $request) {
        @ini_set('max_execution_time', 0);
        @set_time_limit(0);

        Overrider::load("Settings");

        $validator = Validator::make($request->all(), [
            'phone'   => 'required',
            'message' => 'required:max:160',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return back()->withErrors($validator)
                    ->withInput();
            }
        }

        //Send message
        $message = $request->input("message");

        if (get_option('enable_sms') == 0) {
            return back()->with('error', _lang('Sorry, SMS not enabled !'));
        }

        $account_sid   = get_option('twilio_account_sid');
        $auth_token    = get_option('twilio_auth_token');
        $twilio_number = get_option('twilio_mobile_number');
        $client        = new Client($account_sid, $auth_token);

        try {
            $client->messages->create($request->phone,
                ['from' => $twilio_number, 'body' => $message]);
        } catch (\Exception $e) {
            if (!$request->ajax()) {
                return back()->with('error', _lang('Sorry, Error Occured !'));
            } else {
                return response()->json(['result' => 'error', 'message' => _lang('Sorry, Error Occured !')]);
            }
        }

        if (!$request->ajax()) {
            return back()->with('success', _lang('SMS Send Sucessfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('SMS Send Sucessfully'), 'data' => $contact]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', _lang('Deleted successfully'));
    }
}
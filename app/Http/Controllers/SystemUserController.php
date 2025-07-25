<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SystemUserController extends Controller {

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
    public function index() {
        //$locations = User::select('branch_id')->get();
        //dd($locations);
        $users = User::where('user_type', '!=', 'customer')
            ->orderBy('id', 'desc')
            ->get();
        return view('backend.system_user.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $locations = Branch::all()->sortByDesc("id");
        if (!$request->ajax()) {
            return view('backend.system_user.create', compact('locations'));
        } else {
            return view('backend.system_user.modal.create', compact('locations'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'first_name'            => 'required|max:255',
            'middle_name'            => 'nullable|max:255',
            'last_name'            => 'required|max:255',
            'email'           => 'required|email|unique:users|max:255',
            'user_type'       => 'required',
            'status'          => 'required',
            'profile_picture' => 'nullable|image',
            'password'        => 'required|min:6',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
                return errors()->all();
            } else {
                return redirect()->route('system_users.create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $profile_picture = "";
        if ($request->hasfile('profile_picture')) {
            $file            = $request->file('profile_picture');
            $profile_picture = time() . $file->getClientOriginalName();
            $file->move(public_path() . "/uploads/profile/", $profile_picture);
        }
        
        
        
        $user                    = new User();
        $user->first_name              = $request->input('first_name');
        $user->middle_name              = $request->input('middle_name');
        $user->last_name              = $request->input('last_name');
        $user->phone             = $request->input('phone');
        $user->email             = $request->input('email');
        $user->user_type         = $request->input('user_type');
        $user->role_id           = $request->input('role_id');
        $user->status            = $request->input('status');
        $user->branch_id            = $request->input('branch_id');
        $user['branch_id'] = implode(',', $user->branch_id);
        
        $user->profile_picture   = $profile_picture;
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->password          = Hash::make($request->password);
        // $token = Str::random(60);
        // //$user = User::find($user_type, 'admin');
        // $user->api_token = $request->$token;
        // dd($user -> user_type);
       
        $user->save();
        
        //Prefix Output
        $user->status          = status($user->status);
        $user->user_type       = strtoupper($user->user_type);
        $user->role_id         = $user->role->name;
        $user->profile_picture = '<img src="' . profile_picture($user->profile_picture) . '" class="thumb-sm img-thumbnail">';
        

        if (!$request->ajax()) {
            return redirect()->route('system_users.index')->with('success', _lang('Saved successfully'));
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
        $get_branch_id_list = explode(",", $user->branch_id);
        $locations = Branch::whereIn('id', $get_branch_id_list)->get();
        //dd($locations);
        if (!$request->ajax()) {
            return view('backend.system_user.view', compact('user', 'id'));
        } else {
            return view('backend.system_user.modal.view', compact('user', 'id', 'locations'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $locations = Branch::all()->sortByDesc("id");
        $user = User::find($id);
        $get_branch_id_list = explode(",", $user->branch_id);
        $encodeList =json_encode($get_branch_id_list);
        
        $loc = Branch::whereIn('id', $get_branch_id_list)->get();
               

        if (!$request->ajax()) {
            return view('backend.system_user.edit', compact('user', 'id', 'locations','loc','get_branch_id_list', 'encodeList'));
            // return view('backend.system_user.edit', compact('user', 'id', 'locations'));
        } else {
            return view('backend.system_user.edit', compact('user', 'id', 'locations','loc','get_branch_id_list', 'encodeList'));
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
            'middle_name'            => 'nullable|max:255',
            'last_name'            => 'required|max:255',
            'email'           => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ],
            'user_type'       => 'required',
            'status'          => 'required',
            'profile_picture' => 'nullable|image',
            'password'        => 'nullable|min:6',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('system_users.edit', $id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        if ($request->hasfile('profile_picture')) {
            $file            = $request->file('profile_picture');
            $profile_picture = time() . $file->getClientOriginalName();
            $file->move(public_path() . "/uploads/profile/", $profile_picture);
        }

        $user            = User::find($id);
        $user->first_name              = $request->input('first_name');
        $user->middle_name              = $request->input('middle_name');
        $user->last_name              = $request->input('last_name');
        $user->phone             = $request->input('phone');
        $user->email     = $request->input('email');
        $user->user_type = $request->input('user_type');
        $user->role_id   = $request->input('role_id');
        $user->status    = $request->input('status');
        $user->branch_id            = $request->input('branch_id');
        $user['branch_id'] = implode(',', $user->branch_id);
        if ($request->hasfile('profile_picture')) {
            $user->profile_picture = $profile_picture;
        }
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
     
        $user->save();

        //Prefix Output
        $user->status          = status($user->status);
        $user->user_type       = strtoupper($user->user_type);
        $user->role_id         = $user->role->name;
        $user->profile_picture = '<img src="' . profile_picture($user->profile_picture) . '" class="thumb-sm img-thumbnail">';
       
    //   $json = response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated successfully')]);
       return redirect()->route('system_users.index')->with('message', 'Updated Successfully.');

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
        return redirect()->route('system_users.index')->with('success', _lang('Deleted successfully'));
    }
}
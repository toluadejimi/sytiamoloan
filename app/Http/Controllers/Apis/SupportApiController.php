<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use DataTables;
use DB;
use Illuminate\Support\Facades\Validator;


class SupportApiController extends Controller
{
    
    public $successStatus = true;
    public $failedStatus = false;
    
    
    public function index()
    {
        $supporttickets = SupportTicket::select('support_tickets.*')
            ->where('status', $status)
            ->with(['user', 'created_by'])
            ->orderBy("support_tickets.id", "desc");
            
        if ($this->successStatus == true) {
            return response()->json(["status" => $this->successStatus, "data" => $supporttickets]);
        }else{
            return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
        }
    }
    
    public function store(Request $request) 
        {
                $validator = Validator::make($request->all(), [
                    'user_id'    => 'required',
                    'subject'    => 'required',
                    'message'    => 'required',
                    'status'     => 'required',
                    'attachment' => 'nullable|mimes:jpeg,JPEG,png,PNG,jpg,doc,pdf,docx,zip',
                ]);
        
                if ($validator->fails()) {
                    if ($request->ajax()) {
                        return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
                    } else {
                        return redirect()->route('support_tickets.create')
                            ->withErrors($validator)
                            ->withInput();
                    }
                }
        
                $attachment = null;
                if ($request->hasfile('attachment')) {
                    $file       = $request->file('attachment');
                    $attachment = time() . $file->getClientOriginalName();
                    $file->move(public_path() . "/uploads/media/", $attachment);
                }
        
                DB::beginTransaction();
        
                $supportticket                  = new SupportTicket();
                $supportticket->user_id         = $request->input('user_id');
                $supportticket->subject         = $request->input('subject');
                $supportticket->status          = $request->input('status');
                $supportticket->created_user_id = $request->input('created_user_id');;
        
                $supportticket->save();
        
                $message             = new SupportMessage();
                $message->message    = $request->message;
                $message->sender_id  = $request->user_id;
                $message->attachment = $attachment;
        
                $supportticket->messages()->save($message);
        
                DB::commit();
                if ($this->successStatus == true) {
                    return response()->json(["status" => $this->successStatus, "data" => $supportticket]);
                }else{
                    return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
                }
                
                
                
        }
        public function reply(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'message'    => 'required',
            'attachment' => 'nullable|mimes:jpeg,jpg,png,doc,pdf,docx,zip',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $supportticket = SupportTicket::where('id', $id)->where('status', 1)->first();
        if ($supportticket->status == 0) {
            $supportticket->status = 1;
            $supportticket->save();
        }

        $attachment = null;
        if ($request->hasfile('attachment')) {
            $file       = $request->file('attachment');
            $attachment = time() . $file->getClientOriginalName();
            $file->move(public_path() . "/uploads/media/", $attachment);
        }

        $message             = new SupportMessage();
        $message->message    = $request->message;
        $message->sender_id  = auth()->id();
        $message->attachment = $attachment;

        $supportticket->messages()->save($message);

        if ($this->successStatus == true) {
            return response()->json(["status" => $this->successStatus, "data" => $supportticket]);
        }else{
            return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        $supportticket = SupportTicket::find($id);
        if (!$supportticket) {
            abort(404);
        }
        if ($this->successStatus == true) {
            return response()->json(["status" => $this->successStatus, "data" => $supportticket]);
        }else{
            return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
        }
    }

    /**
     * Closed the specified ticket.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function assign_staff($id, $userId) {
        $supportticket              = SupportTicket::where('id', $id)->where('status', 0)->first();
        $supportticket->status      = 1;
        $supportticket->operator_id = $userId;
        $supportticket->save();

        if ($this->successStatus == true) {
            return response()->json(["status" => $this->successStatus, "data" => $supportticket]);
        }else{
            return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
        }
    }

    /**
     * Closed the specified ticket.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mark_as_closed($id) {
        $supportticket                 = SupportTicket::where('id', $id)->where('status', 1)->first();
        $supportticket->status         = 2;
        $supportticket->closed_user_id = auth()->id();
        $supportticket->save();

        if ($this->successStatus == true) {
            return response()->json(["status" => $this->successStatus, "data" => $supportticket]);
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
    public function destroy($id) {
        if (auth()->user()->user_type != 'admin') {
            abort(403);
        }
        $supportticket = SupportTicket::find($id);
        $supportticket->delete();
        
        if ($this->successStatus == true) {
            return response()->json(["status" => $this->successStatus, "data" => $supportticket]);
        }else{
            return response()->json(["status" => $this->failedStatus,'error' => 'Unauthorised'], 401);
        }
    }
}
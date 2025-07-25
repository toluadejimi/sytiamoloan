<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\Loan;
use App\Models\User;
use App\Models\Branch;
use App\Models\Repayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
//use Spatie\QueryBuilder\AllowedFilter;
//use Spatie\QueryBuilder\QueryBuilderFacade as QueryBuilder;
//use App\Http\Controllers\QueryBuilder;
//use QueryBuilder;

class ReportController extends Controller {

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
    public function index(Request $request) {
 
        $reports = Loan::all();
        $from = date($request->datefrom);
       $to = Carbon::parse($request->dateto)->endOfDay();

        $users = User::all();
        
        $sum = 0;
        // $reports = Loan::select()
        // ->whereBetween('created_at',[$from, $to])
        // ->get();
    if(Auth::user()->user_type == 'rmafo' )
    {
        $b_id = explode(",",Auth::user()->branch_id);
        $reports = Loan::with([
            'user','borrower'
            ])->where('created_at','>=',$from)
            ->where('created_at','<=',$to)
            ->where('branch_id',$b_id)
            ->get();
        //dd($reports,$b_id);
        return view('backend.reports.list', compact('reports' ));
    }
        $reports = Loan::with([
            'user','borrower'
            ])->where('created_at','>=',$from)->where('created_at','<=',$to)->get();
        //dd($reports);
        return view('backend.reports.list', compact('reports' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    
    public function create(Request $request) {
       //
    }
    
    
    
     public function afo(Request $request) {
         
          $reports = Repayment::all();
        $from = date($request->datefrom);
       $to = Carbon::parse($request->dateto)->endOfDay();

        $users = User::all();
        // dd($users ->first_name);
        
        $sum = 0;
        // $reports = Loan::select()
        // ->whereBetween('created_at',[$from, $to])
        // ->get();
    
        $reports = [];
        
        $afos = User::where('user_type', 'user')
                    ->orWhere('user_type', 'manager')
                    ->get();
        // dd($reports);   
        
        $sum =0;
        
                    
        return view('backend.reports.afo', compact('reports', 'afos', 'sum' ));
       
       
       
      
       
       
       
       
    }
    
    
     public function quaryafosdata(Request $request) {
        // Repayment::with([
        //     'user','borrower'
        //     ])->where('created_at','>=',$from)->where('created_at','<=',$to)->get();
            
            $from = date($request->datefrom);
            $to = Carbon::parse($request->dateto)->endOfDay();
       
          $repayments =  Repayment::whereBetween('created_at', [$from, $to])
            ->where('agent_id', $request->afo)->orderBy('created_at', 'desc');
            
        $sum = $repayments ->sum('total_paid');
        
        $reports =  $repayments->get();
        
        
            
            $afos = User::where('user_type', 'user')
                    ->orWhere('user_type', 'manager')
                    ->get();
            
        return view('backend.reports.afo', compact('reports', 'afos', 'sum' ));

    }
    
    
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
       //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
    
    
    
    
    
    
    
    
    
    

    public function search(Request $request)
    {
    //     $loans = Loan::all();
    //     // $users = User::all();

    //     $from = $request->input('datefrom');
    //     $to = $request->input('dateto');

    //     // $from = date($request->datefrom);
    //     // $to = date($request->dateto);

    //     // $query = DB::table('loans')->select()
    //     // ->where('created_at', '>=', $from)
    //     // ->where('created_at', '<=', $to)
    //     // ->get();
    //     $loans = QueryBuilder::for(Loan::class)
    //     ->allowedFilters(['created_at'])
    //     ->get();
    //     dd($query);


    }
}
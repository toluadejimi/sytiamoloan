<?php

namespace App\Http\Controllers;

use App\Models\FixedDeposit;
use App\Models\Loan;
use App\Models\PaymentRequest;
use App\Models\SupportTicket;
use App\Models\Transaction;
use App\Models\User;
use App\Models\MRepayment;
use App\Models\Manager;
use DB;
use Auth;
use Illuminate\Support\Arr;

class DashboardController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        date_default_timezone_set(get_option('timezone', 'Asia/Dhaka'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     
    public function index() {
        
        $user      = auth()->user();
        $user_type = $user->user_type;
        $data      = array();
        if($user_type == 'manager'|$user_type == 'user' ){
        
        $b_id = Arr::dot(array(Auth::user()->branch_id));
        
        $trasn = Loan::with('branch')
                    ->where('branch_id', $b_id)
                    ->get();
        $tapplied = Manager::select('amount')
                    ->where('user_id', Auth::user()->id)
                    ->where('status', 1)
                    ->sum('amount');
                    //dd($tapplied);
        $tamount = MRepayment::select('amount')
                    ->where('user_id', Auth::user()->id)
                    ->where('status', 1)
                    ->sum('amount');
      }elseif ($user_type == 'customer') {
            $data['active_tickets']  = SupportTicket::where('status', 1)->where('user_id', auth()->id())->count();
            $data['loans']           = Loan::where('status', 1)->where('borrower_id', auth()->id())->get();
            $data['active_fdr']      = FixedDeposit::where('status', 1)->where('user_id', auth()->id())->count();
            $data['payment_request'] = PaymentRequest::where('status', 1)->where('receiver_id', auth()->id())->count();

            $data['recent_transactions'] = Transaction::where('user_id', auth()->id())
                ->with('currency')
                ->limit(10)
                ->orderBy('id', 'desc')
                ->get();

            $data['account_balance'] = DB::select("SELECT currency.*, (SELECT IFNULL(SUM(amount), 0) FROM transactions
            WHERE dr_cr = 'cr' AND currency_id = currency.id AND transactions.user_id = " . $user->id . ") - (SELECT IFNULL(SUM(amount),0)
            FROM transactions WHERE dr_cr = 'dr' AND currency_id = currency.id AND transactions.user_id = " . $user->id . ") as balance
            FROM currency LEFT JOIN transactions ON currency.id=transactions.currency_id WHERE currency.status=1 GROUP BY currency.id");
        } else {
            $data['active_customer']     = User::where('user_type', 'customer')->where('status', 1)->count();
            $data['inactive_customer']   = User::where('user_type', 'customer')->where('status', 0)->count();
            $data['pending_loan']   = Loan::where('status', 0)->count();
            $data['approved_loan']   = Loan::where('status', 1)->count();
            $data['completed_loan']   = Loan::where('status', 2)->count();
            $data['inflow']   = Loan::sum('total_paid');
            $data['outflow']   = Loan::sum('applied_amount');
            $data['recent_transactions'] = Transaction::limit(10)
                ->with('currency')
                ->orderBy('id', 'desc')
                ->get();
 
        }
      
        $tran = Loan::latest()->get();
        
        if($user_type == 'manager'){
            return view("backend.dashboard-$user_type", $data, compact('tran','trasn','tapplied','tamount'));
        }else{
            return view("backend.dashboard-$user_type", $data, compact('tran'));
        }
        
        
      
    }
    
    // public function manager(){
    //      $user      = auth()->user();
    //     $user_type = $user->user_type;
    //     $data      = array();
    //      $data['active_customer']     = User::where('user_type', 'customer')->where('status', 1)->count();
    //         $data['inactive_customer']   = User::where('user_type', 'customer')->where('status', 0)->count();
    //         $data['pending_loan']   = Loan::where('status', null)->count();
    //         $data['approved_loan']   = Loan::where('status', 1)->count();
    //         $data['completed_loan']   = Loan::where('status', 2)->count();
    //         $data['inflow']   = Loan::sum('total_paid');
    //         $data['outflow']   = Loan::sum('applied_amount');
    //         $data['recent_transactions'] = Transaction::limit(10)
    //             ->with('currency')
    //             ->orderBy('id', 'desc')
    //             ->get();
    //     $tran = Loan::with('branch')
    //                 ->where('branch_id', Auth::user()->branch_id)
    //                 ->get();
    //     $tapplied = Loan::select('applied_amount')
    //                 ->where('branch_id', Auth::user()->branch_id)
    //                 ->sum('applied_amount');
    //     $tpayable = Loan::select('total_payable')
    //                 ->where('branch_id', Auth::user()->branch_id)
    //                 ->sum('total_payable');
    //   return view("backend.manager", $data, compact('tran','tapplied','tpayable'));
    // }

    public function active_users_widget() {
        // Use for Permission Only
        return redirect()->route('dashboard.index');
    }

    public function inactive_users_widget() {
        // Use for Permission Only
        return redirect()->route('dashboard.index');
    }

    public function pending_tickets_widget() {
        // Use for Permission Only
        return redirect()->route('dashboard.index');
    }

    public function deposit_requests_widget() {
        // Use for Permission Only
        return redirect()->route('dashboard.index');
    }

    public function withdraw_requests_widget() {
        // Use for Permission Only
        return redirect()->route('dashboard.index');
    }

    public function loan_requests_widget() {
        // Use for Permission Only
        return redirect()->route('dashboard.index');
    }

    public function fdr_requests_widget() {
        // Use for Permission Only
        return redirect()->route('dashboard.index');
    }

    public function wire_transfer_widget() {
        // Use for Permission Only
        return redirect()->route('dashboard.index');
    }

    public function total_deposit_widget() {
        // Use for Permission Only
        return redirect()->route('dashboard.index');
    }

    public function total_withdraw_widget() {
        // Use for Permission Only
        return redirect()->route('dashboard.index');
    }

    public function recent_transaction_widget() {
        // Use for Permission Only
        return redirect()->route('dashboard.index');
    }
}

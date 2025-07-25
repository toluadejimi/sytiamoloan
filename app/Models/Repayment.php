<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repayment extends Model
{
    use HasFactory;
    
    
     protected $table = 'repayments';

    protected $fillable = [
        'loan_id',
         'loan_product_id',
         'borrower_id',            
         'branch_id',           
         'agent_id',           
         'total_paid',          
         'balance',            
         'status',            
         ];

    public function loans() {
        return $this->belongsTo('App\Models\Loan', 'loan_id')->withDefault();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function borrower() {
        return $this->belongsTo('App\Models\User', 'borrower_id')->withDefault();
    }
    
    public function branch() {
        return $this->belongsTo('App\Models\Branch', 'branch_id')->withDefault();
    }

    public function currency() {
        return $this->belongsTo('App\Models\Currency', 'currency_id')->withDefault();
    }

    public function loan_product() {
        return $this->belongsTo('App\Models\LoanProduct', 'loan_product_id')->withDefault();
    }

    public function approved_by() {
        return $this->belongsTo('App\Models\User', 'approved_user_id')->withDefault();
    }

    public function created_by() {
        return $this->belongsTo('App\Models\User', 'created_user_id')->withDefault();
    }
    // public function getRepaymentDateAttribute($value) {
    //     $date_format = get_date_format();
    //     return \Carbon\Carbon::parse($value)->format("$date_format");
    // }

}

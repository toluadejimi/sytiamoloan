<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MRepayment extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
   protected $table = 'mrepayment'; 

    protected $fillable = [
            'amount',
            'user_id'
    ];
    
    //  public function setBranchAttribute($locations)
    // {
    //     $this->attribute['locations'] = json_encode($locations);
    // }
    
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function borrower() {
        return $this->belongsTo('App\Models\User', 'borrower_id')->withDefault();
    }
    
    public function location() {
        return $this->belongsTo('App\Models\Branch', 'locations')->withDefault();
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

    public function collaterals() {
        return $this->hasMany('App\Models\LoanCollateral', 'loan_id');
    }

    public function repayments() {
        return $this->hasMany(Repayment::class, 'loan_id');
    }
    
     public function breakdown() {
        return $this->hasMany('App\Models\Repayment', 'loan_id');
    }

    public function payments() {
        return $this->hasMany('App\Models\LoanPayment', 'loan_id');
    }

    public function next_payment() {
        return $this->hasOne('App\Models\LoanRepayment', 'loan_id')->where('status', 0)->withDefault();
    }

    public function getFirstPaymentDateAttribute($value) {
        $date_format = get_date_format();
        return \Carbon\Carbon::parse($value)->format("$date_format");
    }

    public function getReleaseDateAttribute($value) {
        if ($value != null) {
            $date_format = get_date_format();
            return \Carbon\Carbon::parse($value)->format("$date_format");
        }
    }

    public function getApprovedDateAttribute($value) {
        if ($value != null) {
            $date_format = get_date_format();
            return \Carbon\Carbon::parse($value)->format("$date_format");
        }
    }

    public function getCreatedAtAttribute($value) {
        $date_format = get_date_format();
        $time_format = get_time_format();
        return \Carbon\Carbon::parse($value)->format("$date_format $time_format");
    }

    public function getUpdatedAtAttribute($value) {
        $date_format = get_date_format();
        $time_format = get_time_format();
        return \Carbon\Carbon::parse($value)->format("$date_format $time_format");
    }

}
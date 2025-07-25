<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail {
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array 
     * 
     */
     
     
    protected $fillable = [
        'first_name',
        'middle_name', 
        'last_name', 
        'email',
        //'country_code', 
        'phone',
        'bvn',
        'address',
        'hbus_stop',
        'shop_address',
        'sbus_stop',
        'dob', 
        'gender',
        //'password', 
        'user_type', 
        'status',
        'branch_id',
        'gname',
        'gphone',
        'gaddress',
        'gbus_stop',
        'gname2',
        'gphone2',
        'gaddress2',
        'g2bus_stop',
        // 'nimc_front',
        // 'nimc_back',
        'profile_picture',
        'gpicture',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function setBranchAttribute($value)
    {
        $this->attribute['branch_id'] = json_encode($value);
    }

    // public function getBranchAttribute($value)
    // {
    //     $this->attribute['branch_id'] = json_decode($value);
    // }

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function loan() { 
    return $this->hasMany(Loan::class); 
    }

    public function getCreatedAtAttribute($value) {
        $date_format = get_date_format();
        $time_format = get_time_format();
        return \Carbon\Carbon::parse($value)->format("$date_format $time_format");
    }

    public function role() {
        return $this->belongsTo('App\Models\Role', 'role_id')->withDefault(['name' => _lang('Default')]);
    }

    public function branch() {
        return $this->belongsTo('App\Models\Branch', 'branch_id')->withDefault(['name' => _lang('Default')]);
    }
    
    
    public function manager() {
        return $this->hasMany('App\Models\Manager', 'user_id')->withDefault();
    }
    
    // public function loan() {
    //     return $this->belongsTo('App\Models\Loan', 'approved_user_id')->withDefault(['name' => _lang('Default')]);
    // }

    public function transactions() {
        return $this->hasMany('App\Models\Transaction', 'user_id')->with('currency')->orderBy('id', 'desc');
    }

    public function loans() {
        return $this->hasMany('App\Models\Loan', 'borrower_id')->with('currency')->orderBy('id', 'desc');
    }

    public function reports() {
        return $this->hasMany('App\Models\Report', 'borrower_id','agent_id')->with('currency')->orderBy('id', 'desc');
    }

    public function fixed_deposits() {
        return $this->hasMany('App\Models\FixedDeposit', 'user_id')->with('currency')->orderBy('id', 'desc');
    }

    public function support_tickets() {
        return $this->hasMany('App\Models\SupportTicket', 'user_id')->orderBy('id', 'desc');
    }
}

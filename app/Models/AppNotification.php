<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppNotification extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'appnotifications';
    
    protected $fillable = [
        'id',
        'message',
        'customer_id',
        'branch_id' ,
        'status'
    ];
    
    
   public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function borrower() {
        return $this->belongsTo('App\Models\User', 'borrower_id')->withDefault();
    }
    
    public function branch() {
        return $this->belongsTo('App\Models\Branch', 'branch_id')->withDefault();
    }
    
    
    
    
}


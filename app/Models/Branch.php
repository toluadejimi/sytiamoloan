<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'branches';
    
    protected $fillable = [
        'name'          ,
        'contact_email' ,
        'contact_phone' ,
        'address'       ,
        'descriptions'  ,
    ];
}
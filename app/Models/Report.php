<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory; 




    public function borrower() {
        return $this->belongsTo('App\Models\User', 'borrower_id')->withDefault();
    }


    public function branch() {
        return $this->belongsTo('App\Models\Branch', 'branch_id')->withDefault();
    }
}

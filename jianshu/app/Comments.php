<?php

namespace App;

use App\Model;

class Comments extends Model
{
    //
    public function user(){
        return $this->belongsTo('\App\User');
    }
}

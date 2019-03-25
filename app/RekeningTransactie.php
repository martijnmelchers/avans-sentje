<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekeningTransactie extends Model
{
    protected $table = "rekening_transactie";

    protected $fillable = [
        'ammount', 'from', 'to',
    ];

    public function from(){
        return $this->hasOne('App\Rekening','from');
    }

    public function to(){
        return $this->hasOne('App\Rekening','to');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RekeningTransactie;

class Rekening extends Model
{

    public $incrementing = false;
    protected $table = "rekeningen";
     
    protected $primaryKey = 'nummer';
    protected $fillable = [
        'name', 'nummer', 'saldo',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function from(){
        return $this->hasMany('App\RekeningTransactie','from', 'nummer');
    }

    public function to(){
        return $this->hasMany('App\RekeningTransactie','to','nummer');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RekeningTransactie;

class Rekening extends Model
{
    use Encryptable;

    public $incrementing = false;
    protected $table = "rekeningen";
     
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'nummer', 'saldo',
    ];

    protected $encryptable = [
        'name',
        'nummer',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function from(){
        return $this->hasMany('App\RekeningTransactie','from', 'id');
    }

    public function to(){
        return $this->hasMany('App\RekeningTransactie','to','id');
    }
}

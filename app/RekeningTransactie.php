<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekeningTransactie extends Model
{
    protected $table = "rekening_transactie";

    public $incrementing = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'amount', 'from', 'to',
    ];

    public function to(){
        return $this->hasOne('App\Rekening','to');
    }
}

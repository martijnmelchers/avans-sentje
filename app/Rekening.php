<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}

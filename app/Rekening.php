<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}

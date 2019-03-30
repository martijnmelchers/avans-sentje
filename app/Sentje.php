<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sentje extends Model
{
    public $incrementing = false;
    protected $table = "sentje";

    protected $primaryKey = 'id';
    protected $fillable = [
        'fixed_amount', 'amount', 'title'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function rekening(){
        return $this->belongsTo('App\Rekening');
    }
}

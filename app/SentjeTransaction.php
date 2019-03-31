<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SentjeTransaction extends Model
{
    public $incrementing = true;
    protected $table = "sentje_transaction";

    protected $primaryKey = 'id';
    protected $fillable = [
        'currency', 'amount', 'converted_amount', 'name', 'message', 'location', 'paid'
    ];

    public function sentje(){
        return $this->belongsTo('App\Sentje');
    }

    public function transactions(){
        return $this->hasMany('App\SentjeTransaction','sentje_id', 'id');
    }
}

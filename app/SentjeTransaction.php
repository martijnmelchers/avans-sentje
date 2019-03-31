<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SentjeTransaction extends Model
{
    public $incrementing = true;
    protected $table = "sentje_transaction";

    protected $primaryKey = 'id';
    protected $fillable = [
        'currency', 'amount', 'converted_amount', 'name', 'message', 'location', 'paid', 'cancelled'
    ];

    public function sentje(){
        return $this->belongsTo('App\Sentje');
    }
}

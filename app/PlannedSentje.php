<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlannedSentje extends Model
{
    protected $table = "planned_sentjes";
    
    
    protected $fillable = [
        'message', 'amount', 'planned', 'recurring',
    ];
}

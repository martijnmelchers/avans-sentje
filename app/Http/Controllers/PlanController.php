<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlannedSentje;

use Auth;
class PlanController extends Controller
{
    public function store(Request $request)
    {
        PlannedSentje::where('user_id', Auth::id())->delete();
        foreach($request->messages as $date => $data){
            $planned = new PlannedSentje;
            $planned->user_id = Auth::id();
            $planned->amount = $data['amount'];
            $planned->message = $data['message'];
            $planned->planned = $date;
            if(isset($data['recurring'])){
                $planned->recurring = 1;
            }
            else {
                $planned->recurring = 0;
            }
            $planned->save();
        }

        return redirect('home');
    }

    public function getPlanned(){
        return Auth::user()->plannedSentjes->toJson();
    }
}

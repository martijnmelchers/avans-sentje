<?php

namespace App\Http\Controllers;

use App\Sentje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class SentjeController extends Controller
{
    public function index()
    {
        return route('rekeningen.index');
    }

    public function titel(Request $request)
    {
        Cookie::queue('amount', $request->input('amount'), 15);
        Cookie::queue('custom', $request->input('custom'), 15);
        Cookie::queue('rekening', $request->input('rekening'), 15);
        return view('sentje.titel');
    }

    public function bedrag(Request $request = null)
    {
        $rekeningen = Auth::User()->rekeningen;
        $rekening = "";

        if ($request != null)
            $rekening = $request->input('rekening');

        if (sizeof($rekeningen) == 0)
            return redirect('rekeningen');

        return view('sentje.bedrag', ["rekeningen" => $rekeningen, "rekening" => $rekening]);

    }

    public function create(Request $request)
    {
        $amount = Cookie::get('amount');
        $custom = Cookie::get('custom');
        $rekening = Cookie::get('rekening');

        if (($amount == null && $custom == null) || $rekening == null)
            return redirect('sentje/maken');

        $sentje = new Sentje;

        $amount = $amount == null ? 0 : $amount;
        $custom = $custom == null ? false : $custom;

        $sentje->id = SentjeController::generateRandomString();
        $sentje->amount = $amount;
        $sentje->fixed_amount = !$custom;
        $sentje->rekening_id = $rekening;
        $sentje->title = $request->input('title');
        $sentje->user_id = Auth::id();

        $sentje->save();

        Cookie::unqueue('amount');
        Cookie::unqueue('custom');
        Cookie::unqueue('rekening');

        Cookie::queue('sentje_id', $sentje->id);

        return redirect('sentje/maken/delen');
    }

    private static function generateRandomString($length = 10)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    public function delen()
    {
        $id = Cookie::get('sentje_id');

        if ($id == null)
            return redirect('/sentje/maken');


        $sentje = Sentje::find($id);
        if ($sentje == null)
            redirect('/sentje/maken');

        return view('sentje.delen', ["sentje" => $sentje]);
    }
}

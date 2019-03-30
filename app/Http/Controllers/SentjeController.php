<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

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

        if ($request != null) {
            $rekening = $request->input('rekening');
        }
        return view('sentje.bedrag', ["rekeningen" => $rekeningen, "rekening" => $rekening]);

    }

    public function create(Request $request)
    {
        $amount = Cookie::get('amount');
        $custom = Cookie::get('custom');
        $rekening = Cookie::get('rekening');

        if(($amount == null && $custom == null) || $rekening == null)
            return redirect('sentje/maken');

        $amount = $amount == null ? 0 : $amount;
        $custom = $custom == null ? false : $custom;

        DB::table('sentje')->insert([
            ['id' => $this->generateRandomString(), 'fixed_amount' => $custom, 'amount' => $amount, 'nummer' => $rekening, 'title' => $request->input('title')]
        ]);

        return redirect('sentje/maken/delen');
    }

    public function delen()
    {
        return view('sentje.titel');
    }

    function generateRandomString($length = 10)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }
}

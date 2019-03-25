<?php

namespace App\Http\Controllers;

class SentjeController extends Controller
{
    public function index()
    {
        return redirect('rekeningen');
    }

    public function titel()
    {
        return view('sentje.titel');
    }

    public function bedrag()
    {
        return view('sentje.titel');

    }

    public function delen()
    {
        return view('sentje.titel');

    }
}

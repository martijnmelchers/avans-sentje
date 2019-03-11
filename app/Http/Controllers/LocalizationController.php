<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    // Sets the locale session
    public function postChangeLocale(Request $request){
    
        // Validate that the selected locale is valid.
        $validatedData = $request->validate([
            'locale' => 'in:nl,en'
        ]);

        $request->session()->put('locale', $request->input('locale'));
        
        return redirect($_SERVER['HTTP_REFERER']);
    }
}

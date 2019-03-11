<?php

namespace App\Http\Middleware;
use Closure;
use App;
class localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->has('locale')){

            $locale = $request->input('locale');
            
            if(in_array($locale, config('app.supported_locale'))){
                $request->session()->put('locale', $locale);
                App::setLocale($locale);                            
            }
        }

        else {
            App::setLocale('en');
        }
        if($request->session()->has('locale')){
            $locale = $request->session()->get('locale');
            App::setLocale($locale);
        }
        return $next($request);
    }
}

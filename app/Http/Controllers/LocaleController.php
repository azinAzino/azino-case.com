<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class LocaleController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $locale)
    {
        if (!in_array($locale, config('app.available_locales'))){
            $locale = 'en';
        }
        Session::put('locale', $locale);
        Session::save();
        return redirect(url(URL::previous()));
    }
}

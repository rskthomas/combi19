<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    //TODO bad code, fix later

    public function create()
    {
        App::setLocale('es');
        if (Auth::check() ) {

            //A user can have many roles, in this case just one
            switch ( Auth::user()->roles[0] -> name ) {
                case 'administrator':
                    return view('administrator.home');
                case 'chofer':
                    return view('chofer.home');
                case 'user':
                    return view('user.search');
            };
        }else

            return view('user.search');
    }

}

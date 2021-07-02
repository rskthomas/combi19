<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lugar;
use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function create()
    {
        $comentarios = DB::table('comentarios')->select('comentarios.*')->orderBy('created_at', 'DESC')->paginate(5);
        if (Auth::check()) {

            $user = Auth::user();
            switch ($user->roles[0]->name) {
                case 'administrator':
                    return view('administrator.home');
                    break;
                case 'chofer':
                    return view('chofer.home')->with('viajes', $user->misViajes());
                    break;
                default:
                    return view('user.search')->with('comentarios', $comentarios);
                    break;
            }
        } else return view('user.search')->with('comentarios', $comentarios);
    }

    public function getAutocompleteData(Request $request)
    {
        return Lugar::where('nombre', 'LIKE', '%' . $request->q . '%')->get();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\User;
use App\Models\Lugar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{


    public function create()

    {    $comentarios = \ DB::table('comentarios')->select('comentarios.*')->orderBy('created_at','DESC')->get();

        if (Auth::guest()) return view('user.search')->with('comentarios', $comentarios);

        else {

            $user = User::find(auth()->user()->id);
            return $user->home()->with('comentarios',$comentarios);
        }
    }

    public function getAutocompleteData(Request $request)
    {
        return Lugar::where('nombre', 'LIKE', '%'.$request->q.'%')->get();
    }
}

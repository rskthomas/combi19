<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lugar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{


    public function create()
    {
        if (Auth::guest()) return view('user.search');

        else {

            $user = User::find(auth()->user()->id);
            return $user->home();
        }
    }

    public function getAutocompleteData(Request $request)
    {
        dd($request->query());
        $search = $request->query;
        $datas = Lugar::where('nombre', 'like', '%' . $search . '%')
            ->orderBy('nombre')
            ->get();

        $dataModified = array();
        foreach ($datas as $data) {
            $dataModified[] = $data->nombre;
        }


        return response()->json($dataModified);
    }
}

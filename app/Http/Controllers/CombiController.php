<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Combi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;

class CombiController extends Controller
{
    public function createCombi()
    {

        $resultado = User::whereRoleIs('chofer')
                ->whereNull('combi_id')
                ->get();

        return view('administrator.combi.altacombi', ['resultado' => $resultado]);
    }

    public function store(Request $request)
    {
        dd($request);

        $request->validate([
            'patente' => 'required|string|max:255|unique:combis',
            'asientos' => 'required|integer|max:255|',
            'isComoda' => 'required|string|max:5|',
            'modelo' => 'required|integer',
            'chofer' => 'nullable',
        ]);

        if ($request -> isComoda = "superComoda"){
            $isComoda = false;
        }else $isComoda = true;


        $combi = Combi::create([
            'patente' => $request->patente,
            'asientos' => $request->asientos,
            'chofer_id' => $request->chofer_id,
            'modelo' => $request->modelo,
            'isComoda' => $isComoda,

        ]);

       event(new Registered($combi));
        /*  Auth::login($combi);*/
     return redirect('administrator/altacombi')->with('popup','open');


    }
}

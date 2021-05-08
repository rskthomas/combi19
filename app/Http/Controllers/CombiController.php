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
        //dd($request);

        $request->validate([

            'patente' => 'required|string|max:255|unique:combis',
            'asientos' => 'required|integer|max:255|',
            'tipo_de_combi' => 'required|string|max:15|',
            'modelo' => 'required|integer',
            'chofer_id' => 'nullable',
        ]);


        $combi = Combi::create([
            'patente' => $request->patente,
            'asientos' => $request->asientos,
            'modelo' => $request->modelo,
            'tipo_de_combi' => $request -> tipo_de_combi,

        ]);

       if ($request ->chofer_id != "null")
       {
           $combi -> chofer_id = $request->chofer_id;
           $chofer = User::find($request -> chofer_id);

           //setear la relacion 1-1 --
           $combi->user()->save($chofer);

       }
        /*  Auth::login($combi);*/
     return redirect('administrator/altacombi')->with('popup','open');

    }

    public function listarCombis()
    {

        $resultado= Combi::paginate(10);

        return view('administrator.combi.listarcombis')->with('resultado',$resultado);
        ;
    }
}

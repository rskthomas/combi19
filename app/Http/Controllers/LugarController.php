<?php

namespace App\Http\Controllers;

use App\Models\Lugar;
use Illuminate\Http\Request;
use PHPUnit\Util\Xml\Validator;

class LugarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultado= Lugar::paginate(10);

        return view('lugar.listarLugares')->with('resultado',$resultado);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        return view('lugar.agregarLugar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request["nombre"] = strtoupper($request->nombre);
        $request["provincia"] = strtoupper($request->provincia);
        $request->validate([
            'nombre' => 'required|string|max:255|unique:lugars',
            'provincia'=> 'required|string'
             ]);



        $lugar= Lugar::create([
            'nombre' => $request->nombre,
            'provincia' =>$request->provincia

        ]);
        return redirect()->to(route('lugar.create'))-> with('popup','ok');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lugar  $lugar
     * @return \Illuminate\Http\Response
     */
    public function show(Lugar $lugar)
   { 
    
      return view('lugar.infoLugar',['lugar' => $lugar]);

       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lugar  $lugar
     * @return \Illuminate\Http\Response
     */
    public function edit(Lugar $lugar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lugar  $lugar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lugar $lugar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lugar  $lugar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lugar $lugar)
    {
        if(isSet($lugar->ruta)){

            return redirect()->to(route('infougar', ['lugar' => $lugar]))-> with('bajaerronea',$lugar);
        }

        $lugar->delete();
        return redirect()->to(route('listarlugares'))-> with('bajaerronea',$lugar);
    }
}

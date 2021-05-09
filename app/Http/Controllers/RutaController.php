<?php

namespace App\Http\Controllers;

use App\Models\ruta;
use App\Models\Combi;
use App\Models\Lugar;
use Illuminate\Http\Request;

class RutaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$combi = Combi::all();
        $combis=Combi::all();
        $lugares = Lugar::all();

        return view('rutas.agregarRuta',['lugares' => $lugares, 'combis'=>$combis]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
      
        $request->validate([

            'salida' => 'required|string|max:255|unique:combis',
            'llegada' => 'required',
            'combi' => 'required',
        ]);
        $ruta = Ruta::create([
            'lugar_llegada' => $request->llegada,
            'lugar_salida' => $request->salida,
            'kms' => $request->kms,
            'tiempo' => $request -> tiempo,

        ]);

       // return view('rutas.listarRutas')->with('resultado',$ruta);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ruta  $ruta
     * @return \Illuminate\Http\Response
     */
    public function show(ruta $ruta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ruta  $ruta
     * @return \Illuminate\Http\Response
     */
    public function edit(ruta $ruta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ruta  $ruta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ruta $ruta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ruta  $ruta
     * @return \Illuminate\Http\Response
     */
    public function destroy(ruta $ruta)
    {
        //
    }
}

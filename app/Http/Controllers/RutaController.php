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

            'salida' => 'required',
            'llegada' => 'required',
            'combi' => 'required',
        ]);
        
        $ruta = Ruta::create([
            'lugar_llegada' => $request->llegada,
            'lugar_salida' => $request->salida,
            'kms' => $request->kms,
            'tiempo' => $request -> tiempo,
            'combi_id'=> $request -> combi

        ]);

        

        return redirect()->to(route('altaruta'))-> with('rutaagregada',$ruta);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ruta  $ruta
     * @return \Illuminate\Http\Response
     */
    public function show(ruta $ruta)
    {
        $resultado= Ruta::paginate(10);

        return view('rutas.listarRuta')->with('resultado',$resultado);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ruta  $ruta
     * @return \Illuminate\Http\Response
     */
    public static function edit(ruta $ruta)
    {
        //
        $combis=Combi::all();
        $lugares = Lugar::all();

        return view('rutas.editarRuta',['ruta'=> $ruta,'lugares' => $lugares, 'combis'=>$combis]);



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
        $request->validate([
            'salida' => 'required',
            'llegada' => 'required',
            'combi' => 'required',
        ]);
        $ruta=ruta::findOrFail($request->id);

        $ruta-> update ($request->all());

        return redirect()->to(route('inforuta', ['ruta' => $ruta->id]))-> with('rutamodificada','open');

     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ruta  $ruta
     * @return \Illuminate\Http\Response
     */
    public static function destroy(ruta $ruta)
    {
        //
        $ruta-> delete();

        return redirect()->to(route('listarrutas'))-> with('rutaeliminada',$ruta);
  
    }
}

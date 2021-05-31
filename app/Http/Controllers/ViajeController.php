<?php

namespace App\Http\Controllers;

use App\Models\Ruta;
use App\Models\Viaje;
use Illuminate\Http\Request;

class ViajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultado= Viaje::paginate(10);

        return view('viajes.listarViajes')->with('resultado',$resultado);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $rutas = Ruta::all();

        return view('entidades.viaje.alta',['rutas' => $rutas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([

            'fecha_salida' => 'required|date',
            'precio' => 'required|numeric',
            'cant_asientos' => 'required|numeric',
            'ruta'=>'required',
            'hora_salida'=>'required',
            'descripcion'=>'required'
        ]);
    
        $ruta = Ruta::where("id","=",$request->ruta)->first();
  
        
        if($ruta->combi ['asientos'] < $request->cant_asientos){
            //$parametros=['error'=>'la cantidad de asientos elegida es mayor a la disponible ','request'=>$request]
            return redirect()->back()->withErrors('la cantidad de asientos elegida es mayor a la disponible para la combi'.$ruta->combi['id']. '('. $ruta->combi['asientos'].')')->withInput();
        }



        $viaje = Viaje::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_salida' => $request->fecha_salida,
            'hora_salida' => $request->hora_salida,
            'precio' => $request -> precio,
            'estado'=>"pendiente",
            'cant_asientos'=> $request -> cant_asientos,
            'ruta_id'=>$request -> ruta,


        ]);

        // return redirect()->to(route('ruta.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Viaje $viaje)
    {
        return view('viajes.info', ['viaje' => $viaje]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

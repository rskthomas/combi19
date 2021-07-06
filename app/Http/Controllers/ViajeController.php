<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Ruta;
use App\Models\Lugar;
use App\Models\Viaje;
use App\Models\Pasaje;
use App\Models\LogViaje;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Database\Eloquent\Collection;


class ViajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $resultado = Viaje::paginate(10);
        return view('entidades.viaje.listar', ['resultado' => $resultado]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $rutas = Ruta::all();

        return view('entidades.viaje.alta', ['rutas' => $rutas]);
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

            'fecha_salida' => 'required|date',
            'precio' => 'required|numeric',
            'cant_asientos' => 'required|numeric',
            'ruta' => 'required',
            'hora_salida' => 'required',
            'descripcion' => 'required'
        ]);

        $ruta = Ruta::where("id", "=", $request->ruta)->first();


        if ($ruta->combi['asientos'] < $request->cant_asientos) {
            //$parametros=['error'=>'la cantidad de asientos elegida es mayor a la disponible ','request'=>$request]
            return redirect()->back()->withErrors('la cantidad de asientos elegida es mayor a la disponible para la combi ' . $ruta->combi['patente'] . '(cantidad de asientos disponibles:' . $ruta->combi['asientos'] . ')')->withInput();
        }

        //If there is a trip with same ruta_id on the same day then
        //check if time is between estimated time



        if (Viaje::seSuperpone($request->fecha_salida, $request->hora_salida, $request->ruta))
            return redirect()->to(route('viaje.create'))->with('combiOcupada', 'open');


        $viaje = Viaje::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_salida' => $request->fecha_salida,
            'hora_salida' => $request->hora_salida,
            'precio' => $request->precio,
            'estado' => "pendiente",
            'cant_asientos' => $request->cant_asientos,
            'ruta_id' => $request->ruta,


        ]);

        return redirect()->to(route('viaje.create'))->with('creado', 'open');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Viaje $viaje)
    {
        //
        return view('entidades.viaje.info', ['viaje' => $viaje]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Viaje $viaje)
    {
        $rutas = Ruta::all();

        return view('entidades.viaje.editar', ['viaje' => $viaje, 'rutas' => $rutas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Viaje $viaje)
    {
        //
        $request->validate([

            'fecha_salida' => 'required|date',
            'precio' => 'required|numeric',
            'cant_asientos' => 'required|numeric',
            'ruta' => 'required',
            'hora_salida' => 'required',
            'descripcion' => 'required'
        ]);
        // dd($request);
        $ruta = Ruta::where("id", "=", $request->ruta)->first();


        if ($ruta->combi['asientos'] < $request->cant_asientos) {
            //$parametros=['error'=>'la cantidad de asientos elegida es mayor a la disponible ','request'=>$request]
            return redirect()->back()->withErrors('la cantidad de asientos elegida es mayor a la disponible para la combi ' . $ruta->combi['patente'] . '(cantidad de asientos disponibles:' . $ruta->combi['asientos'] . ')')->withInput();
        }


        if (Viaje::seSuperpone($request->fecha_salida, $request->hora_salida, $request->ruta, $viaje->id))
            return redirect()->to(route('viaje.info', ['viaje' => $viaje->id]))->with('combiOcupada', 'open');


        $viaje->update($request->all());

        return redirect()->to(route('viaje.info', ['viaje' => $viaje->id]))->with('modificado', 'open');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Viaje $viaje)
    {


        if (count($viaje->pasajes) > 0) {
            return redirect()->to(route('viaje.info', ['viaje' => $viaje]))->with('nosepuedeeliminar', 'open');
        }
        $viaje->delete();


        return redirect()->to(route('viaje.index'))->with('eliminado', $viaje);
    }

    public function search(Request $request)
    {
        $request->validate([

            'fecha_salida' => 'required|date|after:yesterday',
            'departure' => 'required|string|different:destination',
            'destination' => 'required|string',
        ]);


        try {

            $salida = Lugar::where('nombre', '=', $request->departure)->firstOrFail();
            $llegada = Lugar::where('nombre', '=', $request->destination)->firstOrFail();

            $ruta = Ruta::where('lugar_salida', '=', $salida->id)->where('lugar_llegada', '=', $llegada->id)->firstOrFail();

            $results = Viaje::where('ruta_id', '=', $ruta->id)
                ->where('fecha_salida', '=', $request->fecha_salida)->get();
        } catch (Exception $e) {
            $results = Collection::empty();
        };

        return view('entidades.viaje.resultados', ['resultado' => $results]);
    }


    public function iniciar(Viaje $viaje)
    {
        $viaje->update(['estado' => 'activo']);
        $pasajes = $viaje->pasajes()->paginate(10);

        return view('entidades.viaje.iniciar')->with([
            'viaje' => $viaje,
            'pasajes' => $pasajes
        ]);
    }


    public function finalizar(Viaje $viaje)
    {

        $log = LogViaje::create([
            'nombre' => $viaje->nombre,
            'descripcion' => $viaje->descripcion,
            'fecha_salida' => $viaje->fecha_salida,
            'hora_salida' => $viaje->hora_salida,
            'precio' => $viaje->precio,
            'estado' => "realizado",
            'cant_asientos' => $viaje->cant_asientos,
            'pasajes_vendidos' => ($viaje->cant_asientos - $viaje->pasajesLibres()),
            'salida' => $viaje->ruta->salida->nombre,
            'llegada' => $viaje->ruta->llegada->nombre,
            'nombre_chofer' => $viaje->ruta->combi->chofer->name,
            'id_chofer' => $viaje->ruta->combi->chofer->id,
            'mail_chofer' => $viaje->ruta->combi->chofer->email,
        ]);
        //chequear esta condicion de los comentarios con el viaje finalizado porque no esta andando
        $viaje->pasajes->where('estado', '=', 'activo')
            ->each(function ($pasaje, $key) {
                $pasaje->usuario->comproPasaje = true;
                $pasaje->usuario->save();

            });

        $pasajes = Pasaje::where('estado', '=', 'pendiente')->where('viaje_id', '=', $viaje->id)->update(['estado' => 'ausente']);

        $pasajes = Pasaje::where('estado', '=', 'activo')->where('viaje_id', '=', $viaje->id)->update(['estado' => 'finalizado']);



        $pasajes = Pasaje::where('viaje_id', '=', $viaje->id)->update(['viaje_id' => null]);



        $viaje->delete();

        return redirect()->to(RouteServiceProvider::HOME)->with('viajefinalizado', 'open');
    }


    public function cancelar(Viaje $viaje)
    {


        $log = LogViaje::create([
            'nombre' => $viaje->nombre,
            'descripcion' => $viaje->descripcion,
            'fecha_salida' => $viaje->fecha_salida,
            'hora_salida' => $viaje->hora_salida,
            'precio' => $viaje->precio,
            'estado' => "cancelado",
            'cant_asientos' => $viaje->cant_asientos,
            'pasajes_vendidos' => ($viaje->cant_asientos - $viaje->pasajesLibres()),
            'salida' => $viaje->ruta->salida->nombre,
            'llegada' => $viaje->ruta->llegada->nombre,
            'nombre_chofer' => $viaje->ruta->combi->chofer->name,
            'id_chofer' => $viaje->ruta->combi->chofer->id,
            'mail_chofer' => $viaje->ruta->combi->chofer->email,
        ]);
        $pasajes = Pasaje::where('estado', '=', 'pendiente')->where('viaje_id', '=', $viaje->id)->update(['estado' => 'cancelado']);

        $pasajes = Pasaje::where('viaje_id', '=', $viaje->id)->get();

        foreach ($pasajes as $pasaje) {

            $pasaje->update(["dinero_devuelto" => $pasaje->total_compra]);
        }

        Pasaje::where('viaje_id', '=', $viaje->id)->update(['viaje_id' => null]);




        $viaje->delete();

        return redirect()->to(RouteServiceProvider::HOME)->with('viajecancelado', 'open');
    }
}

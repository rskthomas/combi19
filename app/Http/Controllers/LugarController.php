<?php

namespace App\Http\Controllers;

use App\Models\Lugar;
use Illuminate\Http\Request;
use PHPUnit\Util\Xml\Validator;

use function PHPUnit\Framework\isNull;

class LugarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultado = Lugar::paginate(10);

        return view('entidades.lugar.listar')->with('resultado', $resultado);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        return view('entidades.lugar.alta');
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
            'provincia' => 'required|string'
        ]);



        $lugar = Lugar::create([
            'nombre' => $request->nombre,
            'provincia' => $request->provincia

        ]);
        return redirect()->to(route('lugar.create'))->with('popup', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lugar  $lugar
     * @return \Illuminate\Http\Response
     */
    public function show(Lugar $lugar)
    {

        return view('entidades.lugar.info', ['lugar' => $lugar]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lugar  $lugar
     * @return \Illuminate\Http\Response
     */
    public function edit(Lugar $lugar)
    {
        //dd($lugar->ruta);
        if (!($lugar->ruta)->isEmpty() | !($lugar->ruta2)->isEmpty()) {

            return redirect()->to(route('lugar.info', ['lugar' => $lugar]))->with('bajaerronea', $lugar);
        }

        return view('entidades.lugar.editar', ['lugar' => $lugar]);
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

        $request["nombre"] = strtoupper($request->nombre);
        $request["provincia"] = strtoupper($request->provincia);
        $request->validate([
            'nombre' => 'required|string|max:255',
            'provincia' => 'required|string'
        ]);


        if ($request->nombre != $lugar->nombre) {
            $request->validate([
                'nombre' => 'unique:lugars'
            ]);
        }

        $lugar-> update ($request->all());
        return redirect()->to(route('lugar.info', ['lugar' => $lugar->id]))-> with('lugarmodificado','open');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lugar  $lugar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lugar $lugar)
    {
        if (!($lugar->ruta)->isEmpty()| !($lugar->ruta2)->isEmpty()) {

            return redirect()->to(route('lugar.info', ['lugar' => $lugar]))->with('bajaerronea', $lugar);
        }

        $lugar->delete();
        return redirect()->to(route('lugar.index'))->with('lugareliminado', $lugar);
    }
}

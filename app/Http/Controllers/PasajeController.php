<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Viaje;
use App\Models\Pasaje;
use App\Models\Tarjeta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class PasajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $resultado = Pasaje::paginate(10);

        return view('entidades.pasaje.listar')->with('resultado', $resultado);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Viaje $viaje)
    {

        $productos = Producto::all();
        $tarjeta = Auth::user()->tarjeta;
        $data = [
            'productos' => $productos, 'viaje' => $viaje
        ];
        if ($tarjeta) {
           
        }
   
        return view('entidades.pasaje.alta',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Viaje $viaje)
    {
        //
        $id =   Auth::user()->id;
        //dd($id);

        if (!User::find($id)->isGold()) {
            $request->validate([
                'number' => 'required|string|max:17|min:13|unique:tarjetas',
                'name' => 'required|string|max:55',
                'cvc' => 'required|string|max:4',

                'expiration_year' => 'required|string|max:4',
                'expiration_month' => 'required|string|max:2',
            ]);
        }

        if ($request->cantPasajes <= $viaje->pasajesLibres()) {

            $pasaje = Pasaje::create([
                'asiento' => $viaje->siguienteAsiento(),
                'estado' => 'pendiente',
                'total_pasaje' => $request->totalCompra,
                'total_productos' => $request->totalProductos,
                'productos' => "{}",
                'viaje_id' => $viaje->id,
                'user_id' => $id,


            ]);
            $usuario =   User::find(Auth::id());

            $usuario->pasajes()->save($pasaje);
        }

        return redirect()->to(RouteServiceProvider::HOME)->with('pasajeComprado', 'open');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pasaje  $pasaje
     * @return \Illuminate\Http\Response
     */
    public function show(Pasaje $pasaje)
    {
        //

        return view('entidades.pasaje.info', ['pasaje' => $pasaje]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pasaje  $pasaje
     * @return \Illuminate\Http\Response
     */
    public function edit(Pasaje $pasaje)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pasaje  $pasaje
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pasaje $pasaje)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pasaje  $pasaje
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pasaje $pasaje)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\User;
use App\Models\Viaje;
use App\Models\Pasaje;
use App\Models\Tarjeta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\TarjetaController;

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
        if (isset(Auth::user()->bloqueado)) {
            return Redirect::back()->with(['bloqueado', 'true']);
        }
        $productos = Producto::all();
        $tarjeta = Auth::user()->tarjeta;
        $data = [
            'productos' => $productos, 'viaje' => $viaje
        ];
        /*if ($tarjeta) { //??????????????????

        }*/

        return view('entidades.pasaje.alta', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Viaje $viaje)
    {

        $id = Auth::user()->id;


        if (!User::find($id)->isGold() || Auth::user()->tarjeta->vencida() || isset($request->nuevaTarjetaAgregada)) {


            $request->validate([
                'number' => 'required|string|max:17|min:13|unique:tarjetas',
                'name' => 'required|string|max:55',
                'cvc' => 'required|string|max:4',

                'expiration_year' => 'required|string|max:4',
                'expiration_month' => 'required|string|max:2',
            ]);
            if (
                $request->expiration_year < Date("Y", time()) ||
                (($request->expiration_year == Date("Y", time()) && ($request->expiration_month < Date("m", time()))))
            ) {
                return Redirect::back()->withErrors("La tarjeta se encuentra vencida, por favor ingrese otra tarjeta ");
            }
            if (isset($request->serGold)) {


                if (User::find($id)->isGold()) {
                    User::find($id)->tarjeta->delete();
                }

                $tarjeta = Tarjeta::create([
                    'name' => $request->name,
                    'number' => $request->number,
                    'cvc' => $request->cvc,
                    'expiration_year' => $request->expiration_year,
                    'expiration_month' => $request->expiration_month,


                ]);

                Auth::user()->asignarTarjeta($tarjeta);
            }
        }

        if ($request->cantPasajes <= $viaje->pasajesLibres()) {

            $pasaje = Pasaje::create([
                'asiento' => $viaje->siguienteAsiento(),
                'estado' => 'pendiente',
                'total_compra' => $request->totalCompra,
                'total_productos' => $request->totalProductos,
                'total_pasaje' => $request->totalPasaje,
                'total_descuentos' => $request->totalDescuentos,
                'productos' => $request->productos,
                'viaje_id' => $viaje->id,
                'user_id' => $id,
                'nombre' => $viaje->nombre,
                'descripcion' => $viaje->descripcion,
                'fecha_salida' => $viaje->fecha_salida,
                'salida' => $viaje->ruta->salida->nombre,
                'llegada' => $viaje->ruta->llegada->nombre,
                'hora_salida' => $viaje->hora_salida


            ]);
            $usuario = User::find(Auth::id());

            $usuario->pasajes()->save($pasaje);
            $usuario->asignarPasaje();
        }
        $pasaje->save();

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

        return view('entidades.pasaje.info', ['pasaje' => $pasaje, 'productos' => json_decode($pasaje->productos, true)]);
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
        $fecha = date_create_from_format('d-m-Y H:i', $pasaje->fecha_salida . ' ' . $pasaje->hora_salida);
        $dtz = new DateTimeZone('America/Argentina/Buenos_Aires');
        $fecha_actual = new DateTime('now', $dtz);

        if (date_modify($fecha_actual, "+48 hour") > ($fecha)) {
            $devolucion= (($pasaje->total_compra) / 2) ;
            $mensaje = "Su pasaje ha sido cancelado y se le ha devuelto el 50% del pasaje (" . $devolucion . ")";

        } else {
            $devolucion= ($pasaje->total_compra) ;
            $mensaje = "Su pasaje ha sido cancelado y se le ha devuelto el valor del pasaje ($" . $devolucion. ")";
        }

        // setear en cancelado!!!!!!!!!!!!!!!!!!!!
        $pasaje->update(["estado" => "cancelado por el usuario", 'viaje_id' => null,"dinero_devuelto"=>$devolucion]);

        return redirect()->to(route('user.viajes', ['user' => Auth::user()]))
            ->with('mensaje', $mensaje);
    }

    public function getCuestionario(Pasaje $pasaje)
    {

        return view('entidades.pasaje.cuestionario')->with('pasaje', $pasaje);
    }

    public function subir(Request $request, Pasaje $pasaje)
    {
        //dd($request);
        $request->validate([
            'temperatura' => 'required|numeric',
        ]);


        if ((isset($request->preg) and  sizeOf($request->preg) > 1)  || $request->temperatura > '37.9') {
            $pasaje->usuario->bloquear();
            $pasaje->estado = 'rechazado';
            $pasaje->dinero_devuelto = $pasaje->total_compra;
            $pasaje->save();


            return redirect()->to(route('viaje.iniciar', ['viaje' => $pasaje->viaje]))
                ->with('pasaje_rechazado', $pasaje);
        } else {
            $pasaje->estado = 'activo';
            $pasaje->save();

            return redirect()->to(route('pasaje.vianda', ['pasaje' => $pasaje]))
                ->with('pasaje_activo', $pasaje);
        }
    }

    public function ausente(Pasaje $pasaje)
    {
        $pasaje->estado = 'ausente';
        $pasaje->save();

        return redirect()->to(route('viaje.iniciar', ['viaje' => $pasaje->viaje]))
            ->with('pasaje_ausente', $pasaje);
    }


    public function showVianda(Pasaje $pasaje)
    {

        return view('entidades.pasaje.vianda', ['pasaje' => $pasaje, 'productos' => json_decode($pasaje->productos, true)]);
    }

    public function getExpress(Viaje $viaje)
    {

        return view('entidades.pasaje.express')->with('viaje', $viaje);
    }

    public function express(Request $request, Viaje $viaje)
    {
        if ((isset($request->preg) and  sizeOf($request->preg) > 1)  || $request->temperatura > '37.9') {

            return redirect()->to(route('viaje.iniciar', ['viaje' => $viaje]))
                ->with('pasaje_express_rechazado', $request->name);
        }
        else{

        $request->validate([
            'temperatura' => 'required|numeric',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users'
        ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                //this password is "sent" to the user's email
                'password' => Hash::make('12345678'),
                'birthdate'=> '16/06/1995',
                'isGold' => false,
            ]);
            $user->attachRole('user');

            if ($request->cantPasajes <= $viaje->pasajesLibres()) {

                $pasaje = Pasaje::create([
                    'asiento' => $viaje->siguienteAsiento(),
                    'estado' => 'activo',
                    'total_compra' => $viaje->precio,
                    'total_productos' => '0.0',
                    'total_pasaje' => $viaje->precio,
                    'total_descuentos' => '0.0',
                    'productos' => '{}',
                    'viaje_id' => $viaje->id,
                    'user_id' => $user->id,
                    'nombre' => $viaje->nombre,
                    'descripcion' => $viaje->descripcion,
                    'fecha_salida' => $viaje->fecha_salida,
                    'salida' => $viaje->ruta->salida->nombre,
                    'llegada' => $viaje->ruta->llegada->nombre,
                    'hora_salida' => $viaje->hora_salida

                ]);

                $user->pasajes()->save($pasaje);
                $user->asignarPasaje();
            }
            $user->save();
            $pasaje->save();

            return redirect()->to(route('viaje.iniciar', ['viaje' => $viaje]))
                ->with('pasaje_express_exitoso', $user->name);
        }
    }

}

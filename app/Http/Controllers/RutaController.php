<?php

namespace App\Http\Controllers;

use App\Models\Ruta;
use App\Models\Combi;
use App\Models\Lugar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RutaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultado= Ruta::paginate(10);

        return view('rutas.listarRuta')->with('resultado',$resultado);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$combi = Combi::all();
        $combis=Combi::doesntHave('ruta')
                    ->wherehas('chofer')
                       ->get();

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

            'salida' => 'required|numeric',
            'llegada' => 'required',
            'combi' => 'required',
        ]);
        if($request->salida==$request->llegada){
            return redirect()->back()->withErrors('Las terminales de salida y llegada no pueden ser las mismas');
        }




        $ruta = Ruta::create([
            'lugar_llegada' => $request->llegada,
            'lugar_salida' => $request->salida,
            'kms' => $request->kms,
            'tiempo' => $request -> tiempo,
            'combi_id'=> $request -> combi

        ]);



        return redirect()->to(route('ruta.create'))-> with('rutaagregada',$ruta);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ruta  $ruta
     * @return \Illuminate\Http\Response
     */
    public function show(Ruta $ruta)
    {
        return view('rutas.info', ['ruta' => $ruta]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ruta  $ruta
     * @return \Illuminate\Http\Response
     */
    public static function edit(Ruta $ruta)
    {
        //
        $combis=Combi::doesntHave('ruta')
        ->wherehas('chofer')
           ->get();
        $combis->push($ruta->combi);
        $lugares = Lugar::all();

        return view('rutas.editarRuta',['ruta'=> $ruta,'lugares' => $lugares, 'combis'=>$combis]);



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ruta  $ruta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ruta $ruta)
    {
        //
 
        $request->validate([           
            'combi_id' => 'required',
        ]);

        if(isset($request->lugar_salida) and $request->lugar_salida == $request->lugar_llegada){
            return redirect()->back()->withErrors('Las terminales de salida y llegada no pueden ser las mismas');
        }

        $ruta-> update ($request->all());

        return redirect()->to(route('ruta.info', ['ruta' => $ruta->id]))-> with('rutamodificada','open');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ruta  $ruta
     * @return \Illuminate\Http\Response
     */
    public static function destroy(ruta $ruta)
    {
        //

        if(!$ruta->viajes->isEmpty()){
            return redirect() ->to(route('ruta.info', ['ruta' => $ruta->id]))-> with('nosepuedeeliminar','open');

        }
        $ruta-> delete();
        

        return redirect()->to(route('ruta.index'))-> with('rutaeliminada',$ruta);

    }
}

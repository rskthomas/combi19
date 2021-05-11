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
        return view('administrator.combi.altacombi', ['resultado' => User::choferesLibres()]);
    }

    public function listarCombis()
    {
        $resultado = Combi::paginate(10);
        return view('administrator.combi.listar', ['resultado' => $resultado]);
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
            'tipo_de_combi' => $request->tipo_de_combi,
        ]);


        if (isset($request->chofer_id)) {

            $chofer = User::find($request->chofer_id);
            //setear la relacion 1-1 --
            $combi->chofer()->save($chofer);
        }
        event(new Registered($combi));
        /*  Auth::login($combi);*/
        return redirect()->to(route('combi.new'))->with('popup', 'open');
    }

    public function get(Combi $combi)
    {
        return view('administrator.combi.info', ['combi' => $combi]);
    }


    public function edit(Combi $combi)
    {
        return view('administrator.combi.editar', ['combi' => $combi, 'resultado' => User::choferesLibres()]);
    }

    public function update(Combi $combi)
    {
        request()->validate([

            'patente' => 'string|max:255|unique:combis|nullable',
            'asientos' => 'integer|max:255|nullable',
            'tipo_de_combi' => 'string|max:15|nullable',
            'modelo' => 'integer|nullable',
            'chofer_id' => 'nullable',
        ]);

        $combi = Combi::findOrFail($combi->id);

        //borra cualquier chofer que tenga
        if (isset($combi->chofer)) {
            $chofer_viejo = User::find($combi->chofer->id);
            $chofer_viejo->combi()->dissociate();
            $chofer_viejo->save();
        }


        /*  en caso de que no se seleccione la opcion 'ningun chofer'
        se le asigna el chofer del $request (puede ser el viejo)    */
        if (request()->chofer_id != null) {


            $chofer = User::find(request()->chofer_id);
            //setear la relacion 1-1 --
            $combi->chofer()->save($chofer);
        }

            if(   (isSet($combi->ruta) )&& (request()->chofer_id == null) ){
                return redirect()->to(route('combi.info', ['combi' => $combi]))-> with('choferAnclado',$combi);
            }


        $combi->refresh();


        //array_filter() filtra aquellos campos que sean null en $ request
        //de esa manera solo guarda aquellos que fueron modificados
        $input = array_filter(request()->all());
        $combi->update($input);
        $combi->save();

        return redirect()->to(route('combi.info', ['combi' => $combi]))->with('combimodificado', 'open');
    }


    public static function destroy(Combi $combi)
    {

        if(isSet($combi->chofer)){

            return redirect()->to(route('combi.info', ['combi' => $combi]))-> with('tienechofer',$combi);
        }

        if(isSet($combi->ruta)){
            return redirect()->to(route('combi.info', ['combi' => $combi]))-> with('tieneruta',$combi);
        }


        $combi->delete();

        return redirect()->to(route('combi.listar'))-> with('combieliminada',$combi);

    }

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Combi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;

class CombiController extends Controller
{

    const RULES = [
        'patente' => 'required|string|max:255|unique:combis',
        'asientos' => 'required|integer|max:255|',
        'tipo_de_combi' => 'required|string|max:15|',
        'modelo' => 'required|integer',
        'chofer_id' => 'nullable',
    ];

    public function create()
    {
        return view('entidades.combi.alta', ['resultado' => User::choferesLibres()]);
    }

    public function index()
    {
        $resultado = Combi::paginate(10);
        return view('entidades.combi.listar', ['resultado' => $resultado]);
    }


    public function store(Request $request)
    {
        $request->validate(self::RULES);

        $combi = Combi::create([
            'patente' => $request->patente,
            'asientos' => $request->asientos,
            'modelo' => $request->modelo,
            'tipo_de_combi' => $request->tipo_de_combi,
        ]);


        $combi->asignarChofer($request->chofer_id);
        $combi->save();

        return redirect()->to(route('combi.new'))
                         ->with('creacionExitosa', 'open');
    }

    public function show(Combi $combi)
    {
        return view('entidades.combi.info', ['combi' => $combi]);
    }


    public function edit(Combi $combi)
    {
        return view('entidades.combi.editar', ['combi' => $combi, 'resultado' => User::choferesLibres()]);
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

        /*array_filter() filtra aquellos campos que sean null en $ request
        de esa manera solo guarda aquellos que fueron modificados */
        $input = array_filter(request()->all());
        $combi->update($input);


        if ((isset($combi->ruta)) &&
            (is_null(request()->chofer_id))
        ) {
            $key = 'choferanclado';
        } else{
            $combi->desasignarchofer();
            $combi->asignarChofer(request()->chofer_id);
            $key = 'combimodificado';
            $combi->save();
        }

        return redirect()->to(route('combi.info', ['combi' => $combi]))
                         ->with($key, 'open');
    }


    /* Chequea las dependencias y setea el nombre de los mensajes de acuerdo a eso */
    public function destroy(Combi $combi)
    {
        if (isset($combi->ruta)) {
            $key = 'tieneruta';
        } else {
            $combi->desasignarChofer();
            $combi->delete();
            $key = 'combimodificada';
        }

        return redirect()->to(route('combi.listar'))
                         ->with($key, $combi);
    }
}

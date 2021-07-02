<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;


class ChoferesController extends Controller
{

    public function create()
    {
        return view('administrator.altachofer');
    }

    public function index()
    {
        $resultado = User::whereRoleIs('chofer')
            ->paginate(6);
        return view('administrator.listarchoferes')
            ->with('resultado', $resultado);
    }


    public function destroy(User $chofer)
    {

    if (isset($chofer->combi)) {
            $key = 'tienecombi';
        } else {

            DB::table('users')->whereId($chofer->id)
                ->delete();
            $key = 'usuarioeliminado';
        }
        return redirect()->to(route('chofer.index'))
            ->with($key, $chofer->name);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cellphone' => $request->cellphone,
            'combi_id' => 'null'

        ]);

        $user->attachRole('chofer');
        event(new Registered($user));

        return redirect('chofer/alta')->with('exito', 'open');
    }

    public function edit(User $chofer)
    {
        return view('user.modificarperfil', ['user' => $chofer]);
    }

    public function show(User $chofer)
    {
        return view('chofer.profile', ['user' => $chofer]);
    }
}

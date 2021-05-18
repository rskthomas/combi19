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
                    ->with('resultado', $resultado);;
    }


    public static function destroy(User $user)
    {

        if (isset($user->combi)) {
            $key = 'tienencombi';
        } else {

            DB::table('users')->whereId($user->id)
                ->delete();
            $key = 'usuarioeliminado';
        }
        return redirect()->to(route('chofer.index'))
            ->with($key, $user->name);
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

        return redirect('chofer/alta')->with('popup','open');
    }

}

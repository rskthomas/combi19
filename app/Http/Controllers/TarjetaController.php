<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tarjeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;

class TarjetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('entidades.tarjeta.alta');

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
            'number' => 'required|string|max:17|min:13|unique:tarjetas',
            'name' => 'required|string|max:55',
            'cvc' => 'required|string|max:4',

            'expiration_year' => 'required|string|max:4',
            'expiration_month' => 'required|string|max:2',
        ]);

        //if the user is recently registered, it is because it chose the gold option

        if ((Session::pull('is_new_user', 'default')) == 'yes') {

            $tarjeta = Tarjeta::create([
                'name' => $request->name,
                'number' => $request->number,
                'cvc' => $request->cvc,
                'expiration_year' => $request->expiration_year,
                'expiration_month' => $request->expiration_month,

            ]);

            $request->user()->asignarTarjeta($tarjeta);

            return redirect()->to(RouteServiceProvider::HOME)->with('gold');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarjeta  $tarjeta
     * @return \Illuminate\Http\Response
     */
    public function show(Tarjeta $tarjeta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarjeta  $tarjeta
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarjeta $tarjeta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarjeta  $tarjeta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarjeta $tarjeta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarjeta  $tarjeta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarjeta $tarjeta)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultado = Producto::paginate(10);

        return view('entidades.productos.listar')->with('resultado', $resultado);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entidades.productos.alta');
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
           
            'descripcion' => 'required|string',
            'tipo' => 'required|string',
            'precio' => 'required|numeric',
        ]);
        $request["nombre"] = strtoupper($request->nombre);
        $request->validate([
            'nombre' => 'required|string|max:255|unique:productos',
        ]);
        $producto = Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'tipo' => $request->tipo,
        ]);

        return redirect()->to(route('producto.create'))->with('popup', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        return view('entidades.productos.info', ['producto' => $producto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {



        return view('entidades.productos.editar', ['producto' => $producto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric'
        ]);


        if ($request->nombre != $producto->nombre) {
            $request->validate([
                'nombre' => 'unique:productos'
            ]);
        }

        $producto-> update ($request->all());
        return redirect()->to(route('producto.info', ['producto' => $producto->id]))-> with('productomodificado','open');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {


        $producto->delete();
        return redirect()->to(route('producto.index'))->with('productoeliminado', $producto);
    }
    }



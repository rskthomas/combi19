<?php

namespace App\Http\Controllers;

use App\Models\LogViaje;
use Illuminate\Http\Request;

class LogViajeController extends Controller
{
    //

    public function index()
    {
        //
        $resultado = LogViaje::paginate(10);
        return view('entidades.logviajes.reporte', ['resultado' => $resultado]);

    }

    public function search(Request $request){
     
        $registros= LogViaje::query();
       
        if(isset($request->departure)){
        
            $registros = $registros->where('salida', 'LIKE', "%$request->departure%");
         }
         if(isset($request->destination)){
            $registros = $registros->where('salida', '=',"%$request->departure%");
         }

         if(isset($request->fecha_desde)){
            $registros = $registros->where('fecha_salida', '>',$request->fecha_desde);
         }
         if(isset($request->fecha_hasta)){
            $registros = $registros->where('fecha_salida', '<',$request->fecha_hasta);
         }
         
       
        $resultado= $registros->get();
      

      return view('entidades.logviajes.reporte', ['resultado' => $resultado,'busqueda'=>'busqueda']);

    }
    
}

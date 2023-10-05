<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['empleados']=Empleado::paginate(5);
        return view('empleado.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //introducir los datos a la basede datos
        //$datosEmpleado = request()->all();
        $datosEmpleado = request()->except('_token');
//carpeta para subir archivos storage
        if ($request->hasFile('Foto')) {
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
        }
        Empleado::insert($datosEmpleado);
        return response()->json($datosEmpleado);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //se busca el id y se almacena en la variable
        $empleado=Empleado::findOrfail($id);
return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //recepcionamos todos los datos menos _token _method
        $datosEmpleado = request()->except(['_token','_method']);
        // esta parte es la de la imagen
        if ($request->hasFile('Foto')) {
            $empleado=Empleado::findOrfail($id);
            Storage::delete('public/'.$empleado->foto);
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
        }
        //comparo los id
        Empleado::where('id', '=',$id)->update($datosEmpleado);
//buelve a buscar la informacion de acuerdo al id 
         $empleado=Empleado::findOrfail($id);
         //retorna al mismo formulario pero ya actualizado
return view('empleado.edit', compact('empleado'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //
        Empleado::destroy($id);
        return redirect('empleado');
    }
}
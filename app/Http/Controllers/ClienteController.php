<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['clientes']=Cliente::paginate(8);
            return view('cliente.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $campos=[
            'Nombre' => 'required|string|max:100',
            'Apellido' => 'required|string|max:100',
            'Direccion' => 'required|string|max:100',
            'Telefono' => 'required|string|max:100',
            'Sexo' => 'required|string|max:100',
           
           
           ];
           $mensaje=[
           'required'=>'El :attribute es requerido',
           ];
           $this->validate($request, $campos, $mensaje);
           
                   //introducir los datos a la basede datos
                   //$datosCliente = request()->all();
                   $datosCliente= request()->except('_token');
           //carpeta para subir archivos storage
                   Cliente::insert($datosCliente);
                   //return response()->json($datosCliente);
                   return redirect('cliente')->with('mensaje', 'Cliente Agregado');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $cliente=Cliente::findOrfail($id);
        return view('cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $campos=[
            'Nombre' => 'required|string|max:100',
            'Apellido' => 'required|string|max:100',
            'Direccion' => 'required|string|max:100',
            'Telefono' => 'required|string|max:100',
            'Sexo' => 'required|string|max:100',      
        
        
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            ];
            $this->validate($request, $campos, $mensaje);

            $datosCliente = request()->except(['_token','_method']);
        // esta parte es la de la imagen
        //comparo los id
        Cliente::where('id', '=',$id)->update($datosCliente);
//buelve a buscar la informacion de acuerdo al id 
         $cliente=Cliente::findOrfail($id);
         //retorna al mismo formulario pero ya actualizado
//return view('cliente.edit', compact('cliente'));
        return redirect('cliente')->with('mensaje','Cliente Modificado');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        // Encuentra el cliente por su ID y elimínalo
        Cliente::findOrFail($id)->delete();
    
        // Redirige de vuelta a la página de clientes con un mensaje de éxito
        return redirect('cliente')->with('mensaje', 'Cliente Eliminado');
    }
}

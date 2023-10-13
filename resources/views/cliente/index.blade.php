@extends('layouts.app')
@section('content')
<div class="container">

    
        @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('mensaje') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
        @endif
        
    <a href="{{url('cliente/create')}}" class="btn btn-success">Registrar Cliente</a>
    <br>
    <br>
    <table class="table table-light">

        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Telefono</th>
                <th>Sexo</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($clientes as $cliente)
            <tr>
                <td>{{$cliente->id}}</td>
                <td>{{$cliente->Nombre}}</td>
                <td>{{$cliente->Apellido}}</td>
                <td>{{$cliente->Telefono}}</td>
                <td>{{$cliente->Sexo}}</td>
                <td>
                    <a href="{{url('/cliente/'.$cliente->id.'/edit')}}" class="btn btn-warning">

                        Editar
                    </a>

                    |
                    <form action="{{url('/cliente/'.$cliente->id)}}" class="d-inline" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input type="submit" onclick="return confirm('Quieres eliminar')" class="btn btn-danger"
                            value="Eliminar">

                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $clientes->links() !!}
</div>
@endsection
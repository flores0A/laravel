campo index :0
<table class="table table-light">

    <thead class="thead-light">
        <tr>
            <th>ID</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th>Telefono</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($empleados as $empleado)
        <tr>
            <td>{{$empleado->id}}</td>
            <td>
                
            <img src="{{asset('storage').'/'.$empleado->foto}}" width="100" alt="">
           
            </td>
            <td>{{$empleado->nombre}}</td>
            <td>{{$empleado->apellido}}</td>
            <td>{{$empleado->correo}}</td>
            <td>{{$empleado->telefono}}</td>
            <td>
                <a href="{{url('/empleado/'.$empleado->id.'/edit')}}">

                Editar
                </a>
            
            |
                <form action="{{url('/empleado/'.$empleado->id)}}" method="post">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input type="submit" onclick="return confirm('Quieres eliminar')" value="Eliminar">

                </form>


            </td>
        </tr>
        @endforeach
    </tbody>
</table>
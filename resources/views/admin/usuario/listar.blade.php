@extends("layouts.admin")

@section("contenedor")

<a href="{{ route('usuario.create') }}" class="btn btn-primary">Nuevo Usuario</a>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <td>ID</td>
            <td>CORREO</td>
            <td>NOMBRE</td>
            <td>ROLES</td>
            <td>ACCIONES</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $u)        
        <tr>
            <td>{{ $u->id }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ $u->name }}</td>
            <td>
                <ul>
                @foreach ($u->roles as $rol)
                    <li>{{$rol->nombre}}</li>
                @endforeach
                </ul>
            
            </td>
            <td>
                <a href="{{ route('usuario.edit', $u->id) }}" class="btn btn-warning">editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
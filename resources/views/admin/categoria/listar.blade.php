@extends("layouts.admin")
@section("contenedor")

<h1>Listar Categorias</h1>
<a href="/categoria/create">Nueva Categoria</a>

<form action="/categoria" method="get">
    <input type="search" name="buscar" class="form-control">
    <input type="submit" value="buscar">
</form>

<form action="/categoria" method="get">
    <input type="date" name="fini">
    <input type="date" name="ffin">
    <input type="submit">
</form>
<table class="table table-hover table-striped">
    <tr>
        <td>ID</td>
        <td>NOMBRE</td>
        <td>DESCRIPCION</td>
        <td>ACCIONES</td>
    </tr>
    @foreach ($categorias as $cat)
    <tr>
        <td>{{ $cat->id }}</td>
        <td>{{ $cat->nombre }}</td>
        <td>{{ $cat->detalle }}</td>
        <td>
        <a href="/categoria/{{ $cat->id }}/edit">Editar</a>
        <a href="/categoria/{{ $cat->id }}">Mostrar</a>

        <form action="/categoria/{{ $cat->id }}" method="post">
            @csrf
            @Method("DELETE")
            <input type="submit" value="eliminar">
        </form>
        </td>
    </tr>
    @endforeach
</table>

TOTAL: {{ $categorias->total() }}
{{ $categorias->links() }}


@endsection

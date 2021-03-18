<h1>Listar Categorias</h1>
<a href="/categoria/create">Nueva Categoria</a>
<table border="1">
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
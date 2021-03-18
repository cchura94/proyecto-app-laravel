<h1>Editar Categoria</h1>


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form action="/categoria/{{ $categoria->id}}" method="post">
    @csrf
    @method("PUT")
    <label for="">Nombre de Categoria:</label>
    <input type="text" name="nombre" required value="{{ $categoria->nombre }}">
    <br>
    <label for="">Detalle de Categoria:</label>
    <textarea name="detalle">{{ $categoria->detalle }}</textarea>
    <br>
    <input type="submit" value="Guardar">
</form>

@extends("layouts.admin")
@section("contenedor")

<h1>Nueva Categoria</h1>


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form action="/categoria" method="post">
    @csrf
    <label for="">Nombre de Categoria:</label>
    <input type="text" name="nombre" required value="{{ old('nombre') }}">
    <br>
    <label for="">Detalle de Categoria:</label>
    <textarea name="detalle">{{ old('detalle') }}</textarea>
    <br>
    <input type="submit" value="Guardar">
</form>

@endsection
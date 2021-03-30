@extends("layouts.admin")

@section("titulo", "Nuevo Producto")


@section("contenedor")
<!--h1>Nuevo Producto</h1-->

{{ route("producto.store") }}
<br>
{{ url("/producto") }}
<br>
{{asset("build/config/postcss.config.js")}}

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('producto.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <label for="">Nombre Producto:</label>
            <input type="text" name="nombre" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="">Precio Producto:</label>
            <input type="number" step="0.01" name="precio" class="form-control">
        </div>

        <div class="col-md-6">
            <label for="">Cantidad Producto:</label>
            <input type="number" name="cantidad" class="form-control">
        </div>

        <div class="col-md-6">
            <label for="">Seleccionar Categoria:</label>
            <select name="categoria_id" id="" class="form-control">
                @foreach ($categorias as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label for="">Imagen Producto:</label>
            <!--input type="hidden" name="MAX_FILE_SIZE" value="50" /-->
            <input type="file" name="imagen" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="">Descripcion:</label>
            <textarea name="descripcion" class="form-control"></textarea>
        </div>

        <div class="col-md-12">
            <input type="submit" class="btn btn-primary">
        </div>
    </div>
</form>





@endsection
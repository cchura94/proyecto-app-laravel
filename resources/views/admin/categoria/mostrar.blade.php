<h1>Mostrar Categoria</h1>

    <label for="">Nombre de Categoria:</label>
    <input type="text" name="nombre" disabled value="{{ $categoria->nombre }}">
    <br>
    <label for="">Detalle de Categoria:</label>
    <textarea name="detalle" disabled>{{ $categoria->detalle }}</textarea>

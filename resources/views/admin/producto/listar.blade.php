@extends("layouts.admin")

@section("titulo", "Lista de Productos")


@section("css")
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
 @endsection


@section("contenedor")
<a href="{{ route('producto.create') }}" class="btn btn-success">Nuevo Producto</a>
<h1>Listar Productos</h1>

<table id="example1" class="table table-striped table-hover">
    <thead>
    <tr>
        <td>NOMBRE</td>
        <td>PRECIO</td>
        <td>STOCK</td>
        <td>CATEGORIA</td>
        <td>IMAGEN</td>
        <td>ACCIONES</td>
    </tr>
    </thead>
    <tbody>

    
    @foreach ($productos as $prod)        
    <tr>
        <td>{{ $prod->nombre }}</td>
        <td>{{ $prod->precio }}</td>
        <td>{{ $prod->cantidad }}</td>
        <td>{{ $prod->categoria->nombre }}</td>
        <td>
          <img src="{{ asset($prod->imagen) }}" width="130px" alt="">        
        </td>
        <td>
            <a href="{{ route('producto.show',$prod->id) }}" class="btn btn-success">Mostrar</a>
            <a href="{{ route('producto.edit',$prod->id) }}" class="btn btn-warning">Editar</a>

        </td>
    </tr>
    @endforeach
    </tbody>
</table>

@endsection


@section("js")
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

@endsection
@extends("layouts.admin")

@section("titulo", "Lista de Clientes")


@section("css")
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
 @endsection


@section("contenedor")
<a href="{{ route('producto.create') }}" class="btn btn-success">Nuevo Cliente</a>
<h1>Lista de Clientes</h1>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Nuevo Cliente
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('cliente.store') }}" method="post">
      <div class="modal-body">
        
          @csrf
          <label for="">Nombres</label>
          <input type="text" name="nombres" class="form-control">

          <label for="">Apellidos</label>
          <input type="text" name="apellidos" class="form-control">

          <label for="">CI / NIT</label>
          <input type="text" name="ci_nit" class="form-control">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar Clientes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<table id="example1" class="table table-striped table-hover">
    <thead>
    <tr>
        <td>nombres</td>
        <td>apellidos</td>
        <td>Ci/Nit</td>
        <td>user</td>
        <td>ACCIONES</td>
    </tr>
    </thead>
    <tbody>

    
    @foreach ($clientes as $clie)        
    <tr>
        <td>{{ $clie->nombres }}</td>
        <td>{{ $clie->apellidos }}</td>
        <td>{{ $clie->ci_nit }}</td>
        <td></td>
        <td>
            <a href="{{ route('cliente.show',$clie->id) }}" class="btn btn-success">Mostrar</a>
            <a href="{{ route('cliente.edit',$clie->id) }}" class="btn btn-warning">Editar</a>

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
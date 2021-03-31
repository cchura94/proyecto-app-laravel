@extends("layouts.admin")

@section("titulo", "Lista de Pedido")

@section("contenedor")

<a href="{{ route('pedido.create') }}" class="btn btn-primary">Nuevo Pedido</a>

<table id="example1" class="table table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>FECHA PEDIDO</th>
            <th>CLIENTE</th>
            <th>QR</th>
            <th>PRODUCTOS</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pedidos as $ped)
            <tr>
                <td>{{ $ped->id }}</td>
                <td>{{ $ped->created_at }}</td>
                <td> {{ $ped->cliente->nombres }} {{ $ped->cliente->apellidos }} - {{ $ped->cliente->ci_nit }} </td>
                <td>{!! QrCode::size(100)->generate($ped->id); !!}</td>
                <td>
                  <ol>
                    @foreach ($ped->productos as $prod)
                      <li>{{$prod->nombre}}</li>
                    @endforeach                  
                  </ol>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


@endsection


@section("css")
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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
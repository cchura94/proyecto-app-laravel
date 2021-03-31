@extends("layouts.admin")

@section("titulo", "ADMINISTRACION")

@section("contenedor")

<h1>ADMIN</h1>

@if (session('mensaje'))
    <div class="alert alert-danger">
        {{ session('mensaje') }}
    </div>
@endif

@endsection
@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background:white">
                <li class="breadcrumb-item"><a href="/compras/proveedor">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detalles</li>
        </ol>
</nav>
<div class="jumbotron text-center">
        <h2>{{$persona->nombre}}</h2>
        <ul class="list-group">
                <li class="list-group-item">Correo: {{$persona->email}}</li>
                <li class="list-group-item">Direccion: {{$persona->direccion}}</li>
                <li class="list-group-item">Telefono: {{$persona->telefono}}</li>
        </ul>
</div>
@endsection
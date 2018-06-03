@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background:white">
                <li class="breadcrumb-item"><a href="/almacen/articulo">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detalles</li>
        </ol>
</nav>
<div class="jumbotron text-center">
        <h2>{{$articulo->nombre}}</h2>
        <p>{{$articulo->descripcion}}</p>
</div>
@endsection
@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background:white">
                <li class="breadcrumb-item"><a href="/almacen/categoria">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detalles</li>
        </ol>
</nav>
<div class="jumbotron text-center">
        <h2>{{$categoria->nombre}}</h2>
        <p>{{$categoria->descripcion}}</p>
</div>
@endsection
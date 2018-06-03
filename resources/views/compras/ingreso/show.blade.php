@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background:white">
                <li class="breadcrumb-item"><a href="/compras/ingreso">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detalles</li>
        </ol>
</nav>
<div class="jumbotron text-center">
        <h2>{{$ingreso->nombre}}</h2>
        <ul class="list-group">
                @foreach ($detalles as $detalle )
                <li class="list-group-item">Articulo: {{$detalle->articulon}}</li>   
                <li class="list-group-item">Precio de Compra: {{$detalle->precio_compra}}</li>     
                <li class="list-group-item">Precio de Venta: {{$detalle->precio_venta}}</li>      
                @endforeach
        </ul>
</div>
@endsection
@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-11 col-md-10 col-sm-10 col-xs-10">
            @include('ventas.venta.search')
        </div>
            <a href="/ventas/venta/create">
                <i class="fas fa-plus-circle fa-2x"  style="color:#00c0ef"></i>
            </a>
    </div>
    <table class="table text-center"> 
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Proveedor</th>
                <th>Comprobante</th>
                <th>Impuestos</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
             @foreach($ventas as $ven)
            <tr>
                <td>{{$ven->fecha_hora}}</td>
                <td><a class="text-dark" href="/ventas/venta/{{$ven->idventa}}">{{$ven->nombre}}</a></td>
                <td>{{$ven->tipo_comprobante . ': ' . $ven->serie_comprobante . '-' . $ven->num_comprobante }}</td>
                <td>{{$ven->impuesto}}</td>
                <td>{{$ven->total_venta}}</td>
                <td>{{$ven->estado}}ctivo</td>
                <td>
                    {!!Form::open(['action' => ['ventaController@destroy', $ven->idventa], 'method' => 'POST','class' => 'inline'])!!}
                        <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                        {{Form::hidden('_method', 'DELETE')}}
                    {!!Form::close()!!}
                </td>
            </tr>
        </tbody>
        @endforeach
    </table> 
@endsection
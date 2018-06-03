@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-11 col-md-10 col-sm-10 col-xs-10">
            @include('compras.ingreso.search')
        </div>
            <a href="/compras/ingreso/create">
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
            @foreach($ingresos as $ingreso)
            <tr>
                <td>{{$ingreso->fecha_hora}}</td>
                <td><a class="text-dark" href="/compras/ingreso/{{$ingreso->idingreso}}">{{$ingreso->nombre}}</a></td>
                <td>{{$ingreso->tipo_comprobante . ': ' . $ingreso->serie_comprobante . '-' . $ingreso->num_comprobante }}</td>
                <td>{{$ingreso->impuesto}}</td>
                <td>{{number_format($ingreso->total)}} COP</td>
                <td>{{$ingreso->estado}}ctivo</td>
                <td>
                    {!!Form::open(['action' => ['Ingreso@destroy', $ingreso->idingreso], 'method' => 'POST','class' => 'inline'])!!}
                        <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                        {{Form::hidden('_method', 'DELETE')}}
                    {!!Form::close()!!}
                </td>
            </tr>
        </tbody>
        @endforeach
    </table> 
@endsection
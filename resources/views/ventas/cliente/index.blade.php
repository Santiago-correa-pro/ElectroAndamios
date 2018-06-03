@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-11 col-md-10 col-sm-10 col-xs-10">
            @include('ventas.cliente.search')
        </div>
            <a href="/ventas/cliente/create">
                <i class="fas fa-plus-circle fa-2x"  style="color:#00c0ef"></i>
            </a>
    </div>
    <table class="table text-center"> 
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Tipo Doc.</th>
                <th>Numero Doc.</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($personas as $persona)
            <tr>
                <td>{{$persona->idpersona}}</td>
                <td><a class="text-dark" href="/ventas/cliente/{{$persona->idpersona}}">{{$persona->nombre}}</a></td>
                <td>{{$persona->tipo_documento}}</td>
                <td>{{$persona->num_documento}}</td>
                <td>{{$persona->telefono}}</td>
                <td>{{$persona->email}}</td>
                <td>
                    <a class="text-dark" href="/ventas/cliente/{{$persona->idpersona}}/edit">
                        <button class="btn btn-info"><i class="far fa-edit"></i></button>
                    </a>
                    {!!Form::open(['action' => ['Person@destroy', $persona->idpersona], 'method' => 'POST','class' => 'inline'])!!}
                        <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                        {{Form::hidden('_method', 'DELETE')}}
                    {!!Form::close()!!}
                </td>
            </tr>
        </tbody>
        @endforeach
    </table> 
@endsection
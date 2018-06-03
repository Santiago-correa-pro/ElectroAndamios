@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-11 col-md-10 col-sm-10 col-xs-10">
            @include('inc.search')
        </div>
            <a href="/almacen/categoria/create">
                <i class="fas fa-plus-circle fa-2x"  style="color:#00c0ef"></i>
            </a>
    </div>
    <table class="table text-center"> 
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $categoria)
            <tr>
                <td>
                    <a class="text-dark" href="/almacen/categoria/{{$categoria->idcategoria}}">{{$categoria->nombre}}</a>
                </td>
                <td>{{$categoria->descripcion}}</td>
                <td>
                    <a class="text-dark" href="/almacen/categoria/{{$categoria->idcategoria}}/edit">
                        <button class="btn btn-info"><i class="far fa-edit"></i></button>
                    </a>
                    {!!Form::open(['action' => ['Category@destroy', $categoria->idcategoria], 'method' => 'DELETE','class' => 'inline'])!!}
                        <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                    {!!Form::close()!!}
                </td>
            </tr>
        </tbody>
        @endforeach
    </table> 
@endsection
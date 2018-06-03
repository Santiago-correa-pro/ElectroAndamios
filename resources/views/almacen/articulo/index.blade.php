@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-11 col-md-10 col-sm-10 col-xs-10">
            @include('almacen.articulo.search')
        </div>
            <a href="/almacen/articulo/create">
                <i class="fas fa-plus-circle fa-2x"  style="color:#00c0ef"></i>
            </a>
    </div>
    <table class="table text-center"> 
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Codigo</th>
                <th>Categoria</th>
                <th>Stock</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articulos as $articulo)
            <tr>
                <td>{{$articulo->idarticulo}}</td>
                <td><a class="text-dark" href="/almacen/articulo/{{$articulo->idarticulo}}">{{$articulo->nombre}}</a></td>
                <td>{{$articulo->codigo}}</td>
                <td>{{$articulo->category}}</td>
                <td>{{$articulo->stock}}</td>
                <td>{{$articulo->estado}}</td>
                <td>
                    <a class="text-dark" href="/almacen/articulo/{{$articulo->idarticulo}}/edit">
                        <button class="btn btn-info"><i class="far fa-edit"></i></button>
                    </a>
                    {!!Form::open(['action' => ['Article@destroy', $articulo->idarticulo], 'method' => 'POST','class' => 'inline'])!!}
                        <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                        {{Form::hidden('_method', 'DELETE')}}
                    {!!Form::close()!!}
                </td>
            </tr>
        </tbody>
        @endforeach
    </table> 
@endsection
@extends('layouts.admin')

@section('content')
<div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                @if(count($errors)>0)
                <div class="alert alert-danger">
                        <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                        </ul>
                </div>
                @endif
         </div>
</div>
    {!!Form::open(['action' => ['Category@update', $categoria->idcategoria], 'method' => 'POST'])!!}
        <div class="form-group">
                {{Form::token()}}
                {{Form::label('nombre', 'Nombre de la Categoria')}}
                {{Form::text('nombre', $categoria->nombre, ['class' => 'form-control', 'placeholder' => 'Nombre de la categoria...'])}}
        </div>
        <div class="form-group">
                {{Form::label('descripcion', 'Descripcion')}}
                {{Form::text('descripcion', $categoria->descripcion, ['class' => 'form-control', 'placeholder' => 'Descripcion...'])}}
        </div>
        <div class="form-group">
                {{Form::hidden('condicion', '1', ['class' => 'form-control', 'placeholder' => 'Condicion...'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        <a href="/almacen/categoria">
                <button class="btn btn-danger">Cancelar</button> 
            </a>
        {{Form::submit('Crear Nueva Categoria', ['class' => 'btn btn-primary'])}}
    {!!Form::close()!!}
@endsection
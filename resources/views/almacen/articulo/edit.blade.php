@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Actualizar Articulo: {{$articulo->nombre}}</h3>
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
    {!!Form::open(['action' => ['Article@update', $articulo->idarticulo], 'method' => 'POST'])!!}
    {{Form::token()}}
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                    {{Form::label('nombre', 'Nombre del Articulo')}}
                    {{Form::text('nombre',$articulo->nombre, ['class' => 'form-control', 'placeholder' => 'Nombre...'])}}
            </div>
        </div>  
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    {{Form::label('idcategoria', 'Nombre de la Categoria')}}
                    {{Form::select('idcategoria', $select , null,['class' => 'form-control'])}}
                </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">  
            <div class="form-group">
                {{Form::label('descripcion', 'Descripcion')}}
                {{Form::text('descripcion', $articulo->descripcion, ['class' => 'form-control'])}}
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                {{Form::label('codigo', 'Codigo')}}
                {{Form::text('codigo', $articulo->codigo , ['class' => 'form-control'])}}
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                {{Form::label('stock', 'Stock')}}
                {{Form::number('stock', $articulo->stock , ['class' => 'form-control'   ])}}
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Actualizar Articulo', ['class' => 'btn btn-primary'])}}
            {{Form::reset('Cancelar',['class' => 'btn btn-danger'])}}
        </div>
    </div>
 {!!Form::close()!!}
@endsection
@extends('layouts.admin')

    @section('content')
    {!!Form::open(['action' => 'Category@store', 'method' => 'POST'])!!}
        <div class="form-group">
                {{Form::token()}}
                {{Form::label('nombre', 'Nombre de la Categoria')}}
                {{Form::text('nombre', '', ['class' => 'form-control', 'placeholder' => 'Nombre de la categoria...'])}}
        </div>
        <div class="form-group">
                {{Form::label('descripcion', 'Descripcion')}}
                {{Form::text('descripcion', '', ['class' => 'form-control', 'placeholder' => 'Descripcion...'])}}
        </div>
        <div class="form-group">
                {{Form::hidden('condicion', '1', ['class' => 'form-control', 'placeholder' => 'Condicion...'])}}
        </div>
        {{Form::submit('Crear Nueva Categoria', ['class' => 'btn btn-primary'])}}
    {!!Form::close()!!}
@endsection
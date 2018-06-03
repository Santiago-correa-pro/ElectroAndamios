@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Actualizer Proveedor</h3>
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
     {!!Form::open(['action' => ['Provider@update', $persona->idpersona], 'method' => 'POST'])!!}
        {{Form::token()}}
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                        {{Form::label('nombre', 'Nombre del Cliente')}}
                        {{Form::text('nombre', $persona->nombre, ['class' => 'form-control', 'placeholder' => 'Nombre...'])}}
                </div>
            </div>  
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    {{Form::label('tipo_documento', 'Tipo de documento')}}
                    {{Form::text('tipo_documento', $persona->tipo_documento, ['class' => 'form-control', 'placeholder' => 'Tipo de documento...'])}}
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">  
                <div class="form-group">
                    {{Form::label('num_documento', 'Numero de documento')}}
                    {{Form::text('num_documento', $persona->num_documento, ['class' => 'form-control', 'placeholder' => 'Numero de documento...'])}}
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    {{Form::label('direccion', 'Direccion')}}
                    {{Form::text('direccion', $persona->direccion, ['class' => 'form-control', 'placeholder' => 'Direccion.....'])}}
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    {{Form::label('telefono', 'Telefono')}}
                    {{Form::text('telefono', $persona->telefono, ['class' => 'form-control', 'placeholder' => 'Numero de telefono..'])}}
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    {{Form::label('email', 'Email')}}
                    {{Form::email('email', $persona->email, ['class' => 'form-control', 'placeholder' => 'Correo Electronico..'])}}
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                {{Form::submit('Actualizar Proveedor', ['class' => 'btn btn-primary'])}}
                {{Form::reset('Cancelar',['class' => 'btn btn-danger'])}}
            </div>
        </div>
        {{Form::hidden('_method', 'PUT')}}
     {!!Form::close()!!}
@endsection
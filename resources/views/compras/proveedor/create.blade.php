@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nuevo Proveedor</h3>
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
     {!!Form::open(['action' => ['Provider@store'], 'method' => 'POST'])!!}
        {{Form::token()}}
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                        {{Form::label('nombre', 'Nombre del Cliente')}}
                        {{Form::text('nombre', old('nombre'), ['class' => 'form-control', 'placeholder' => 'Nombre...'])}}
                </div>
            </div>  
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    {{Form::label('tipo_documento', 'Tipo de documento')}}
                    {{Form::text('tipo_documento', old('tipo_documento'), ['class' => 'form-control', 'placeholder' => 'Tipo de documento...'])}}
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">  
                <div class="form-group">
                    {{Form::label('num_documento', 'Numero de documento')}}
                    {{Form::text('num_documento', old('num_documento'), ['class' => 'form-control', 'placeholder' => 'Numero de documento...'])}}
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    {{Form::label('direccion', 'Direccion')}}
                    {{Form::text('direccion', old('direccion'), ['class' => 'form-control', 'placeholder' => 'Direccion...'])}}
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    {{Form::label('telefono', 'Telefono')}}
                    {{Form::text('telefono', old('telefono'), ['class' => 'form-control', 'placeholder' => 'Numero de telefono..'])}}
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    {{Form::label('email', 'Email')}}
                    {{Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Correo Electronico..'])}}
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                {{Form::submit('Crear Nuevo Proveedor', ['class' => 'btn btn-primary'])}}
                {{Form::reset('Cancelar',['class' => 'btn btn-danger'])}}
            </div>
        </div>
     {!!Form::close()!!}
@endsection
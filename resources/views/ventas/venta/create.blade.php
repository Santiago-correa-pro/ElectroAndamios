@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nueva Venta</h3>
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
     {!!Form::open(['action' => ['ventaController@store'], 'method' => 'POST'])!!}
        {{Form::token()}}
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <div class="form-group">
                    {{Form::label('idcliente', 'Cliente')}}
                    {{Form::select('idcliente', $personas , null,['class' => 'form-control'])}}
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    {{Form::label('tipo_comprobante', 'Tipo de Comprobante')}}
                    {{Form::select('tipo_comprobante', $comprobante , null,['class' => 'form-control'])}}
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                    <div class="form-group">
                        {{Form::label('serie_comprobante', 'Serie de comprobante')}}
                        {{Form::text('serie_comprobante', old('serie_comprobante'), ['class' => 'form-control', 'placeholder' => 'Serie del comprobante....'])}}
                    </div>
                </div>
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    {{Form::label('num_comprobante', 'Numero de comprobante')}}
                    {{Form::text('num_comprobante', '', ['class' => 'form-control', 'placeholder' => 'Numero del comprobante....'])}}
                </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <div class="card-group mb-3 text-center">
                    <div class="card">
                        <div class="card-body">
                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                        <div class="form-group">
                                            {{Form::label('idarticulo', 'Articulo')}}
                                            <select name="idarticulo" class="form-control" id="idarticulo">
                                                @foreach ($articulos as $articulo)
                                                <option value="{{$articulo->idarticulo}}_{{$articulo->stock}}_{{$articulo->precio_promedio}}">{{$articulo->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                                        <div class="form-group">
                                            {{Form::label('cantidad', 'Cantidad')}}
                                            {{Form::number('cantidad', old('cantidad'), ['class' => 'form-control','id' => 'cantidad', 'placeholder' => 'Cantidad....'])}}
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                                            <div class="form-group">
                                                {{Form::label('stock', 'Stock')}}
                                                <input type="number" name="stock" disabled id="stock" class="form-control" placeholder="Stock..."></input>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                                                <div class="form-group">
                                                    {{Form::label('precio_venta', 'Precio de Venta')}}
                                                    <input type="number" name="precio_venta" disabled id="precio_venta" class="form-control" placeholder="Precio de Venta..."></input>
                                                </div>
                                        </div>
                                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                                        <div class="form-group">
                                            {{Form::label('descuento', 'Descuento')}}
                                            <input type="number" name="descuento" id="descuento" class="form-control" placeholder="Descuento..."></input>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 float-right mb-4">
                                        <button type="button" id="bt-add" class="btn btn-primary">Agregar</button>
                                    </div>
                                <div class="col-l g-12 col-sm-12 col-md-12 col-xs-12">
                                        <table id="detalles" class="table table-striped ">
                                            <thead style="background-color: #A9D05F">
                                                <th>Opciones</th>
                                                <th>Articulo</th>
                                                <th>Cantidad</th>
                                                <th>Precio Venta</th>
                                                <th>Descuento</th>
                                                <th>Subtotal</th>
                                            </thead>
                                            <tfoot>
                                                <th>Total</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th><h4 id="total">COP/. 0.00</h4> <input type="hidden" name="total_venta" id="total_venta" /></th>
                                            </tfoot>
                                            <tbody></tbody>
                                        </table>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
                {{ csrf_field() }}
                {{Form::submit('Crear Nueva Venta', ['class' => 'btn btn-primary'])}}
                {{Form::reset('Cancelar',['class' => 'btn btn-danger'])}}
            </div>
        </div>
     {!!Form::close()!!}
    @push('scripts')
        <script>
            $(document).ready(() => {
                $('#bt-add').click(() => {
                    agregar();
                })
            })

            $('#idarticulo').change(mostrarValores);

            let total = 0;
            let cont = 0;
            let subtotal = [];
            let data = idarticulo.value.split('_');
            
            $('#guardar').hide();

            function mostrarValores() {
                $('#precio_venta').val(parseInt(data[2]));
                $('#stock').val(data[1]);
            }
            
            function agregar() {
                let idarticulo = data[0];
                let articulo = $('#idarticulo option:selected').text();
                let cantidad = $('#cantidad').val();
                let descuento = $('#descuento').val();
                let precio_venta = $('#precio_venta').val();
                let stock = $('#stock').val();

                if(idarticulo != "" && cantidad > 0 && precio_venta != "" && descuento != "") {

                    if(stock >= cantidad) {
                        subtotal[cont] = (cantidad * precio_venta - descuento);
                        total = total+subtotal[cont];

                        let fila =
                        `<tr class="selected" id="fila${cont}">
                        <td><button class="btn btn-warning" onclick="eliminar(${cont})" type="button">X</button></td>
                        <td><input type="hidden" name="idarticulo[]" value="${idarticulo}">${articulo}</td>
                        <td><input type="number" name="cantidad[]" value="${cantidad}"></td>
                        <td><input type="number" name="precio_venta[]" value="${precio_venta}"></td>
                        <td><input type="number" name="descuento[]" value="${descuento}"></td><td>${subtotal[cont]}</td>
                        </tr>`;

                        cont++;

                        $('#total').html('COP/. ' + total);
                        $('#total_venta').val(total);
                        evaluate();
                        $('#detalles').append(fila);

                        cleanUp();
                    }
                    else {
                        alert('La cantidad a vender supera el stock')
                        } 
                    }   else {
                        alert('Error al ingresar el detalle del ingreso, revisa los datos del articulo')
                    }
            }

            function cleanUp() {
                $('#descuento').val("");
                $('#precio_venta').val("");
                $('#cantidad').val("");
            }

            function evaluate() {
                if(total > 0) {
                    $('#guardar').show();
                } else {
                    $('#guardar').hide();
                }
            }

            function eliminar(index) {
                total = total-subtotal[index];
                $('#total').html('COP/. ' + total);
                $('#total_venta').val(total);
                $('#fila' + index).remove();
                evaluate();
            }

        </script>
     @endpush
@endsection

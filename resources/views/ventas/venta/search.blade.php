{!!Form::open(['action' => 'ventaController@index', 'method' => 'GET'])!!}
    <div class="form-group">
            {{Form::token()}}
            {{Form::text('searchText', '', ['class' => 'form-control', 'placeholder' => 'Buscar Venta...'])}}
    </div>
{!!Form::close()!!}
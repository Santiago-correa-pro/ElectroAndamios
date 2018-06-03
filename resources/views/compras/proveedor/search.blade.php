{!!Form::open(['action' => 'Provider@index', 'method' => 'GET'])!!}
    <div class="form-group">
            {{Form::token()}}
            {{Form::text('searchText', '', ['class' => 'form-control', 'placeholder' => 'Buscar Proveedor...'])}}
    </div>
{!!Form::close()!!}
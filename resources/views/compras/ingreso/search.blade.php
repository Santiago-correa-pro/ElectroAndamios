{!!Form::open(['action' => 'Ingreso@index', 'method' => 'GET'])!!}
    <div class="form-group">
            {{Form::token()}}
            {{Form::text('searchText', '', ['class' => 'form-control', 'placeholder' => 'Buscar Ingreso...'])}}
    </div>
{!!Form::close()!!}
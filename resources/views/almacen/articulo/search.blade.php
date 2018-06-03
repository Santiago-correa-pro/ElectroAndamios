{!!Form::open(['action' => 'Article@index', 'method' => 'GET'])!!}
    <div class="form-group">
            {{Form::token()}}
            {{Form::text('searchText', '', ['class' => 'form-control', 'placeholder' => 'Buscar por articulo...'])}}
    </div>
{!!Form::close()!!}
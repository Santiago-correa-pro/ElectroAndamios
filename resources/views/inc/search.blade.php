{!!Form::open(['action' => 'Category@index', 'method' => 'GET'])!!}
    <div class="form-group">
            {{Form::token()}}
            {{Form::text('searchText', '', ['class' => 'form-control', 'placeholder' => 'Buscar por categoria...'])}}
    </div>
{!!Form::close()!!}
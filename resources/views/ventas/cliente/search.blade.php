{!!Form::open(['action' => 'Person@index', 'method' => 'GET'])!!}
    <div class="form-group">
            {{Form::token()}}
            {{Form::text('searchText', '', ['class' => 'form-control', 'placeholder' => 'Buscar cliente...'])}}
    </div>
{!!Form::close()!!}
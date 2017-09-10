<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Nom</th>
        <th>Description</th>
        <th>Places restantes</th>
        <th>Debut</th>
        <th>Fin</th>
        <th>List des inscits</th>
        <th>Modifier</th>
        <th>Supprimer</th>

    </tr>
    </thead>
    <tbody>

        @foreach($list as $elem)
            <tr>
                <th scope="row">{{$elem->id}}</th>
            <td>{{$elem->name}}</td>
            <td>{{$elem->title}}</td>
            <td>{{$elem->open_spots}}</td>
            <td>{{$elem->start_time}}</td>
            <td>{{$elem->end_time}}</td>
                <td>{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' =>array('event_reserve.show',$elem->id))) !!}
                    {{Form::token()}}
                    {{ Form::submit('List des inscrits', array('class' => 'button-primary')) }}
                    {!! Form::close() !!}</td>
            <td>{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' =>array('events.edit',$elem->id))) !!}
            {{Form::token()}}
            {{ Form::submit('Modifier', array('class' => 'button-primary')) }}
                {!! Form::close() !!}</td>

            <td>{!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' =>array('events.destroy',$elem->id))) !!}
            {{Form::token()}}
            {{ Form::submit('Suprimer', array('class' => 'button')) }}
                {!! Form::close() !!}</td>
            </tr>
        @endforeach


    </tbody>
</table>
<h2>Liste des inscrits</h2>
<table class="table u-full-width">
    <thead>
    <tr>
        <th>User id</th>
        <th>User name</th>
        <th>User mail</th>
        <th>Horaire de la reservation</th>
        <th>Marquer comme absent</th>
        <th>Supprimer la reservation</th>
    </tr>
    </thead>
    <tbody>
@foreach($elem as $el)
        <tr>
            <th scope="row">
            {{$el->user_id}}</th>
            <td>{{$el->user_name}}</td>
            <td>{{$el->user_email}}</td>
            <td>{{$el->event_retime}}</td>
            <td>{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' =>array('blacklist.edit',$el->user_id))) !!}
                {{Form::token()}}
                {{ Form::submit('Absent', array('class' => 'button-primary')) }}
                {!! Form::close() !!}</td>

            <td>{!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE','action' =>array('EventListController@destroy',$el->user_id.'/'.$el->event_id))) !!}
                {{Form::token()}}
                {{ Form::submit('Suprimer', array('class' => 'button')) }}
                {!! Form::close() !!}</td>
        </tr>
@endforeach

    </tbody>
</table>
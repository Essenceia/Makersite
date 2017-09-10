//TODO a completer
<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Nom</th>
        <th>Description</th>
        <th>Type</th>
        <th>Superviseur</th>
        <th>Points pour utilisation</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $elem)
        <tr>
            <th scope="row">{{$elem->id}}</th>
            <td>{{$elem->name}}</td>
            <td>{{$elem->desc}}</td>
            <td>{{$elem->type}}</td>
            <td>{{$elem->supervision}}</td>
            <td>{{$elem->pointcost}}</td>
            <td>{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' =>array('machinecontroller.edit',$elem->id))) !!}
                {{Form::token()}}
                {{ Form::submit('Modifier', array('class' => 'button-primary')) }}
                {!! Form::close() !!}</td>

            <td>{!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' =>array('machinecontroller.destroy',$elem->id))) !!}
                {{Form::token()}}
                {{ Form::submit('Suprimer', array('class' => 'button')) }}
                {!! Form::close() !!}</td>
        </tr>
    @endforeach


    </tbody>
</table>
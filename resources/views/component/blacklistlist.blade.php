<h2>Liste des utilisateurs sur le Blacklist</h2>
<table class="table u-full-width">
    <thead>
    <tr>
        <th>{{__('account.nom')}}</th>
        <th>{{__('account.mail')}}</th>
        <th>{{__('blacklist.blcreat')}}</th>
        <th>{{__('blacklist.blupdate')}}</th>
        <th>{{__('blacklist.blchancesleft')}}</th>
        <th>{{__('main.modif')}}</th>
        <th>{{__('main.sup')}}</th>
    </tr>
    </thead>
    <tbody>
@foreach($elem as $el)
        <tr>
            <th scope="row">{{$el->user_name}}</th>
            <td>{{$el->user_email}}</td>
            <td>{{$el->bl_created}}</td>
            <td>{{$el->bl_updated}}</td>
            <td>{{$el->bl_chances}}</td>
            <td>{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' =>array('blacklist.edit',$el->id))) !!}
                {{Form::token()}}
                {{ Form::submit('Enlever une chance', array('class' => 'button-primary')) }}
                {!! Form::close() !!}</td>

            <td>{!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' =>array('blacklist.destroy',$el->id))) !!}
                {{Form::token()}}
                {{ Form::submit('Suprimer', array('class' => 'button-primary')) }}
                {!! Form::close() !!}</td>
        </tr>
@endforeach

    </tbody>
</table>
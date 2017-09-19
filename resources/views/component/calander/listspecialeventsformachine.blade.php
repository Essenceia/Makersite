<h2>{{(__('calander.listspecialevent'))}}</h2>

<table class="table u-full-width">
    <thead>
    <tr>
        <th>{{(__('calander.specialeventname'))}}</th>
        <th>{{(__('main.desc'))}}</th>
        <th>{{(__('main.modif'))}}</th>
        <th>{{(__('main.sup'))}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($elem as $el)
        <tr>
            <th scope="row">
                {{$el->name}}</th>
            <td>{{$el->desc}}</td>
            <td>{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' =>array('machine_special_event.edit',$el->id))) !!}
                {{Form::token()}}
                {{ Form::submit((__('main.modif')), array('class' => 'button-primary')) }}
                {!! Form::close() !!}</td>

            <td>{!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE','route' =>array('machine_special_event.destroy',$el->id))) !!}
                {{Form::token()}}
                {{ Form::submit((__('main.sup')), array('class' => 'button')) }}
                {!! Form::close() !!}</td>
        </tr>
    @endforeach

    </tbody>
</table>
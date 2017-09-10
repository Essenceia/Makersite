<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>{{(__('main.name'))}}</th>
        <th>{{(__('main.desc'))}}</th>
        <th>{{(__('main.modif'))}}</th>
        <th>{{(__('main.sup'))}}</th>
    </tr>
    </thead>
    <tbody>

    @foreach($elem as $el)
        <tr>
            <th scope="row">{{$el->id}}</th>
            <td>{{$el->name}}</td>
            <td>{{$el->desc}}</td>
            <td>{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' =>array('machinetype.edit',$el->id))) !!}
                {{Form::token()}}
                {{ Form::submit((__('main.edit')), array('class' => 'button-primary')) }}
                {!! Form::close() !!}</td>

            <td>{!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' =>array('machinetype.destroy',$el->id))) !!}
                {{Form::token()}}
                {{ Form::submit((__('main.sup')), array('class' => 'button')) }}
                {!! Form::close() !!}</td>
        </tr>
    @endforeach


    </tbody>
</table>
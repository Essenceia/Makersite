<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>{{(__('machine.mnom'))}}</th>
        <th>{{(__('main.desc'))}}</th>
        <th>{{(__('machine.mtype'))}}</th>
        <th>{{(__('machine.msupervision'))}}</th>
        <th>{{(__('machine.mcout'))}}</th>
        <th>{{(__('machine.caldef'))}}</th>
        <th>{{(__('main.modif'))}}</th>
        <th>{{(__('main.sup'))}}</th>
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
            <td>{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' =>array('defaultcalander.edit',$elem->id))) !!}
                {{Form::token()}}
                {{ Form::submit((__('machine.cal')), array('class' => 'button-primary')) }}
                {!! Form::close() !!}</td>
            <td>{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' =>array('machine.edit',$elem->id))) !!}
                {{Form::token()}}
                {{ Form::submit((__('main.modif')), array('class' => 'button-primary')) }}
                {!! Form::close() !!}</td>

            <td>{!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' =>array('machine.destroy',$elem->id))) !!}
                {{Form::token()}}
                {{ Form::submit((__('main.sup')), array('class' => 'button')) }}
                {!! Form::close() !!}</td>
        </tr>
    @endforeach


    </tbody>
</table>
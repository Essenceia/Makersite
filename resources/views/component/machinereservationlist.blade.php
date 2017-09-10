<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>{{(__('calander.date'))}}</th>
        <th>{{(__('machine.mid'))}}</th>
        <th>{{(__('account.id'))}}</th>
        <th>{{(__('account.mail'))}}</th>
        <th>{{(__('main.desc'))}}</th>
        <th>{{(__('main.updated_at'))}}</th>
        <th>{{(__('blacklist.enlverchance'))}}</th>
        <th>{{(__('main.sup'))}}</th>
    </tr>
    </thead>
    <tbody>

    @foreach($elem as $el)
        <tr>
            <th scope="row">{{$el->resaid}}</th>
            <td>{{$el->date}}</td>
            <td>{{$el->mid}}</td>
            <td>{{$el->user_id}}</td>

            <td>{{$el->user_mail}}</td>
            <td>{{$el->desc}}</td>
            <td>{{$el->updated_at}}</td>
            <td>{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' =>array('blacklist.edit',$el->user_id))) !!}
                {{Form::token()}}
                {{ Form::submit((__('blacklist.enlverchance')), array('class' => 'button-primary')) }}
                {!! Form::close() !!}</td>

            <td>{!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' =>array('machine_reservation.destroy',$el->resaid))) !!}
                {{Form::token()}}
                {{ Form::submit((__('main.sup')), array('class' => 'button')) }}
                {!! Form::close() !!}</td>
        </tr>
    @endforeach


    </tbody>
</table>
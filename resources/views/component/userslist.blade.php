<table class="table u-max-full-width">
    <thead>
    <tr>
        <th>{{__('account.id')}}</th>
        <th>{{__('account.nom')}}</th>
        <th>{{__('account.mail')}}</th>
        <th>{{__('account.statu')}}</th>
        <th>{{__('account.positionprojet')}}</th>
        <th>{{__('account.credit')}}</th>
        <th>{{__('blacklist.enlverchance')}}</th>
        <th>{{__('account.modif')}}</th>
        <th>{{__('account.sup')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($elem as $el)
        <tr>
            <th scope="row">{{$el->id}}</th>
            <td>{{$el->name}}</td>
            <td>{{$el->email}}</td>
            <td>{{__('account.statu'.$el->status)}}</td>
            <td>@if($el->is_leader === 1)
                    <div id="toprojectpage">{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' =>array('projet.show',$el->project_id))) !!}
                    {{Form::token()}}
                    {{ Form::submit('Chef de projet', array('class' => 'button-primary')) }}
                        {!! Form::close() !!}</div>



            @else
                {{__("account.positionprojet0")}}
                    @endif
            </td>

            <td>{{$el->points}}</td>
            <!-- blacklist -1 chance -->
            <td>{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' =>array('blacklist.edit',$el->id))) !!}
                {{Form::token()}}
                {{ Form::submit((__('blacklist.enlverchance')), array('class' => 'button-primary')) }}
                {!! Form::close() !!}</td>
            <!--modifer l'utilisateur-->

            <td>{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' =>array('account.edit',$el->id))) !!}
                {{Form::token()}}
                {{ Form::submit((__('main.modif')), array('class' => 'button-primary')) }}
                {!! Form::close() !!}</td>
            <!-- Supprimer l'utilisateur-->
            <td>{!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' =>array('account.destroy',$el->id))) !!}
            {{Form::token()}}
            {{ Form::submit((__('main.sup')), array('class' => 'button-primary')) }}
            {!! Form::close() !!}</td>
        </tr>
    @endforeach

    </tbody>
</table>
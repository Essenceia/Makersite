<h2>Liste des inscrits</h2>
<table class="table u-full-width">
    <thead>
    <tr>
        <th>#</th>
        <th>{{(__('faq.questiontxt'))}}</th>
        <th>{{(__('faq.awnser'))}}</th>
        <th>{{(__('main.edit'))}}</th>
        <th>{{(__('main.sup'))}}</th>
    </tr>
    </thead>
    <tbody>
@foreach($elem as $el)
        <tr>
            <th scope="row">
            {{$el->id}}</th>
            <td>{{$el->question}}</td>
            <td>{{$el->awnser}}</td>
            <td>{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' =>array('faq.edit',$el->id))) !!}
                {{Form::token()}}
                {{ Form::submit((__('main.edit')), array('class' => 'button-primary')) }}
                {!! Form::close() !!}</td>

            <td>{!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE','route' =>array('faq.destroy',$el->id))) !!}
                {{Form::token()}}
                {{ Form::submit((__('main.sup')), array('class' => 'button')) }}
                {!! Form::close() !!}</td>
        </tr>
@endforeach

    </tbody>
</table>
<div class="two columns">
    {!!Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' =>[$route,$pagenumber])) !!}
    {{Form::token()}}
    {{ Form::submit($txt, array('class' => 'button-primary')) }}
    {!! Form::close() !!}
</div>
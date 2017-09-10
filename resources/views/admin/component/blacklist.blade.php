<div class="row">
    <div class="four columns">
        <h1>{{__('manage.blacklist')}}</h1>
    </div>


    {!!Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' =>'blacklist.index')) !!}
    {{Form::token()}}
    {{ Form::submit('Afficher Blacklist', array('class' => 'button-primary')) }}
    {!! Form::close() !!}</div>
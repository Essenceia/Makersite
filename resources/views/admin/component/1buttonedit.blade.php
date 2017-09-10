<div class="row">
    <div class="four columns"><h1>{{$title}}</h1></div>
    <div class="eight columns">
        {{ Form::open(array('class' => 'form-inline', 'method' => 'GET','route'=>$routename.'.index'))}}
        {{Form::token()}}
        {{ Form::submit((__('main.modif')), array('class' => 'button-primary u-full-width')) }}
        {!! Form::close() !!}</div>
</div>
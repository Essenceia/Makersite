<br>
{!! Form::open(array('class' => 'form-inline', 'method' => 'POST', 'route' =>'mail.store')) !!}
{{Form::token()}}
{{ Form::label('title', (__('mail.title')), ['class' => 'control-label']) }}
{{ Form::text('title',"",['class'=>'u-full-width']) }}
<br>
{{ Form::label('content', (__('mail.content')), ['class' => 'control-label']) }}
{{ Form::textarea('content', "",['class'=>'u-full-width']) }}

<hr>
{{ Form::submit((__('mail.send')), array('class' => 'button-primary u-full-width')) }}
{!! Form::close() !!}
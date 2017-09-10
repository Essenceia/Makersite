{!! Form::open(array('class' => 'form-inline', 'method' => 'POST', 'route' =>'faq.store')) !!}
{{Form::token()}}
{{ Form::label('question', (__('faq.questiontxt')), ['class' => 'control-label']) }}
{{ Form::text('question', (__('faq.defquestion')),['class'=>'u-full-width']) }}
{{ Form::label('awnser', (__('faq.awnser')), ['class' => 'control-label']) }}
{{ Form::text('awnser', (__('faq.defawnser')),['class'=>'u-full-width']) }}
{{ Form::submit((__('main.creat')), array('class' => 'button-primary ')) }}
{!! Form::close() !!}
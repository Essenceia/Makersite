{!! Form::open(array('class' => 'form-inline', 'method' => 'POST', 'route' =>array('faq.update',$elem->id))) !!}
{{Form::token()}}
{{ Form::label('question', (__('faq.questiontxt')), ['class' => 'control-label']) }}
{{ Form::text('question', $elem->question,['class'=>'u-full-width']) }}
{{ Form::label('awnser', (__('faq.awnser')), ['class' => 'control-label']) }}
{{ Form::text('awnser', $elem->awnser,['class'=>'u-full-width']) }}
{{ Form::submit((__('main.update')), array('class' => 'button-primary ')) }}
{!! Form::close() !!}
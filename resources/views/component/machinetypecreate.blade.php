<h1>{{__('machinetype.createtitle')}}</h1>
<br>
{!! Form::open(array('class' => 'form-inline', 'method' => 'POST', 'route' =>'machinetype.store')) !!}
{{Form::token()}}
{{ Form::label('name', (__('machinetype.name')), ['class' => 'control-label']) }}
{{ Form::text('name', (__('main.namedef')),['class'=>'u-full-width']) }}
{{ Form::label('desc', (__('machinetype.desc')), ['class' => 'control-label']) }}
{{ Form::text('desc', (__('main.descdef')),['class'=>'u-full-width']) }}

{{ Form::submit((__('main.creat')), array('class' => 'button-primary ')) }}
{!! Form::close() !!}
<h3>{{__('events.creatwarning')}}</h3>
{!! Form::open(array('class' => 'form-inline', 'method' => 'POST', 'route' =>'events.store')) !!}
{{Form::token()}}
{{ Form::label('name', (__('events.nameevent')), ['class' => 'control-label']) }}
{{ Form::text('name', (__('main.namedef')),['class'=>'u-full-width']) }}
{{ Form::label('desc', (__('main.desc')), ['class' => 'control-label']) }}
{{ Form::text('desc', (__('main.descdef')),['class'=>'u-full-width']) }}
{{ Form::label('open_spots', (__('events.nspots')), ['class' => 'control-label']) }}
{{ Form::number('open_spots',5,['class'=>'u-full-width']) }}
<div class="row">
{{ Form::label('start_time_day', (__('events.start_time_day')), ['class' => 'control-label']) }}
    {{Form::date('start_time_day',date('Y-m-d'))}}
{{ Form::label('start_time_time', (__('events.start_time_time')), ['class' => 'control-label']) }}
    {{Form::date('start_time_time',date('H:i:s'))}}
</div>
<div class="row">
    {{ Form::label('end_time_day', (__('events.end_time_day')), ['class' => 'control-label']) }}
    {{Form::date('end_time_day',date('Y-m-d'))}}
    {{ Form::label('end_time_time', (__('events.end_time_time')), ['class' => 'control-label']) }}
    {{Form::date('end_time_time',date('H:i:s'))}}
</div>
{{ Form::submit((__('main.creat')), array('class' => 'button-primary ')) }}
{!! Form::close() !!}
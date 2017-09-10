<br>
{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' =>'projet.store')) !!}
{{Form::token()}}
{{ Form::label('userid', (__('project.userid')), ['class' => 'control-label']) }}
{{ Form::number('userid', 0,['class'=>'u-full-width']) }}
{{ Form::label('name', (__('project.name')), ['class' => 'control-label']) }}
{{ Form::text('name', (__('main.namedef')),['class'=>'u-full-width']) }}
<div class="row">
    <div class="six columns">{{ Form::label('type', (__('project.type')), ['class' => 'control-label']) }}
        {{Form::select('type', [0=>(__('project.type0')) ,1=>(__('project.type1')),2=>(__('project.type2'))], (__('project.type0')))}}</div>
    <div class="six columns">{{ Form::label('number', (__('project.number')), ['class' => 'control-label']) }}
        {{ Form::number('number', 150,['class'=>'u-full-width']) }}</div>
</div>

<br>
{{ Form::submit((__('main.update')), array('class' => 'button-primary u-full-width')) }}
{!! Form::close() !!}
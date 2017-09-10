<br>
{!! Form::open(array('class' => 'form-inline', 'method' => 'PUT', 'route' =>array('projet.update',$elem->id))) !!}
{{Form::token()}}
{{ Form::label('name', (__('project.name')), ['class' => 'control-label']) }}
{{ Form::text('name', $elem->name,['class'=>'u-full-width']) }}
<div class="row">
    <div class="six columns">{{ Form::label('type', (__('project.type')), ['class' => 'control-label']) }}
        {{Form::select('type', [0=>(__('project.type0')) ,1=>(__('project.type1')),2=>(__('project.type2'))], (__('project.type'.$elem->type)))}}</div>
    <div class="six columns">{{ Form::label('number', (__('project.number')), ['class' => 'control-label']) }}
        {{ Form::number('number', $elem->number,['class'=>'u-full-width']) }}</div>
</div>

{{ Form::label('points', (__('account.creditprojet')), ['class' => 'control-label']) }}
{{ Form::number('points', $elem->points,['class'=>'u-full-width']) }}
<br>
{{ Form::submit((__('main.update')), array('class' => 'button-primary u-full-width')) }}
{!! Form::close() !!}
<h1>{{(__('machinetype.modiftype',['name'=>$elem->name]))}}</h1>
<br>
{!! Form::open(array('class' => 'form-inline', 'method' => 'PUT', 'route' =>array('machinetype.update',$elem->id))) !!}
{{Form::token()}}
{{ Form::label('name', (__('machinetype.name')), ['class' => 'control-label']) }}
{{ Form::text('name', $elem->name,['class'=>'u-full-width']) }}
{{ Form::label('desc', (__('machinetype.desc')), ['class' => 'control-label']) }}
{{ Form::text('desc', $elem->desc,['class'=>'u-full-width']) }}

{{ Form::submit((__('main.creat')), array('class' => 'button-primary ')) }}
{!! Form::close() !!}
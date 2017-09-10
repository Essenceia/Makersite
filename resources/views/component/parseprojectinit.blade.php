<br>
{!! Form::open(array('class' => 'form-inline', 'method' => 'POST', 'route' =>'parse_project.store')) !!}
{{Form::token()}}
{{Form::label('data',(__('project.parseprojectinfo',['classe'=>'control-label'])))}}
{{Form::textarea('data',(__('project.datagoeshere')),['class'=>'u-full-width'])}}
<br>
{{ Form::submit((__('project.parse')), array('class' => 'button-primary u-full-width')) }}
{!! Form::close() !!}
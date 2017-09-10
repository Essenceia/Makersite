{!! Form::open(array('class' => 'form-inline', 'method' => 'PUT', 'route' =>array('account.update',$elem->id))) !!}
{{Form::token()}}
{{ Form::label('name', (__('account.nom')), ['class' => 'control-label']) }}
{{ Form::text('name', $elem->name,['class'=>'u-full-width']) }}

{{ Form::label('email', (__('account.mail')), ['class' => 'control-label']) }}
{{ Form::text('email', $elem->email,['class'=>'u-full-width']) }}
{{ Form::label('status', (__('account.statu')), ['class' => 'control-label']) }}
{{Form::select('status', [0=>(__('account.statu0')) ,1=>(__('account.statu1')),2=>(__('account.statu2')),3=>(__('account.statu3'))], (__('account.statu'.$elem->status)))}}
{{ Form::label('point', (__('account.credit')), ['class' => 'control-label']) }}
{{ Form::number('point', $elem->points,['class'=>'u-full-width']) }}

{{ Form::submit((__('main.update')), array('class' => 'button-primary ')) }}
{!! Form::close() !!}
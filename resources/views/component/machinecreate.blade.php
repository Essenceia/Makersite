{!! Form::open(array('class' => 'form-inline', 'method' => 'POST', 'route' =>'machine.store')) !!}
{{Form::token()}}
{{ Form::label('name', (__('machine.mnom')), ['class' => 'control-label']) }}
{{ Form::text('name', (__('machine.mnomdef')),['class'=>'u-full-width']) }}
{{ Form::label('desc', (__('main.desc')), ['class' => 'control-label']) }}
{{ Form::text('desc', (__('main.descdef')),['class'=>'u-full-width']) }}
{{ Form::label('type', (__('machine.mtype')), ['class' => 'control-label']) }}
@if(isset($data))
<select id="type" name="type">
    @foreach($data as $type)
        <option value="{{$type->id}}"
                @if($type->id === 1)
                selected="selected"
                @endif
        >{{$type->name}}</option>
    @endforeach
</select>
@endif
{{ Form::label('pointcost', (__('machine.mcout')), ['class' => 'control-label']) }}
{{ Form::number('pointcost', 0,['class'=>'u-full-width']) }}
<div class="row">
{{ Form::label('supervisiom', (__('machine.msupervision')), ['class' => 'control-label']) }}
<!-- TODO trouver comment activer un checkbox -->
    {{Form::checkbox('supervision', true),['class'=>'u-full-width']}}
</div>
{{ Form::submit((__('main.creat')), array('class' => 'button-primary ')) }}
{!! Form::close() !!}
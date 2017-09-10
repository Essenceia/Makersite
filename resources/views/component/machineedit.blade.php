{!! Form::open(array('class' => 'form-inline', 'method' => 'PUT', 'route' =>array('machine.update',$elem->id))) !!}
{{Form::token()}}
{{ Form::label('name',(__('machine.mnom')), ['class' => 'control-label']) }}
{{ Form::text('name', $elem->name,['class'=>'u-full-width']) }}
{{ Form::label('desc', (__('machine.mdesc')), ['class' => 'control-label']) }}
{{ Form::text('desc', $elem->desc,['class'=>'u-full-width']) }}
{{ Form::label('type', (__('machine.mtype')), ['class' => 'control-label']) }}

<select id="type" name="type">
    @foreach($data as $type)
        <option value="{{$type->id}}"
                @if($type->id == $elem->type)
                    selected="selected"
                @endif
        >{{$type->name}}</option>
        @endforeach
</select>
{{ Form::label('pointcost', (__('machine.mcout')), ['class' => 'control-label']) }}



{{ Form::number('pointcost',
 $elem->pointcost,['class'=>'u-full-width']) }}
<div class="row">
{{ Form::label('supervisiom', (__('machine.msupervision')), ['class' => 'control-label']) }}
    <!-- TODO trouver comment activer un checkbox -->
{{Form::checkbox('supervision', $elem->supervision),['class'=>'u-full-width']}}
</div>
{{ Form::submit((__('main.update')), array('class' => 'button-primary ')) }}
{!! Form::close() !!}
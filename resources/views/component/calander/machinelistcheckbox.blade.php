<!-- Fait une list des checkbox pour les machines -->
@foreach($elem as $machine)
    <div class="row"><div class="twelve columns">
            {{ Form::label('machine['.$machine->id.']',$machine->name, ['class' => 'control-label']) }}
            @if($activeid == $machine->id)
                {{Form::checkbox('machine['.$machine->id.']', true)}}
                @else
            {{Form::checkbox('machine['.$machine->id.']', $machine->id)}}
                @endif
        </div> </div>

    @endforeach
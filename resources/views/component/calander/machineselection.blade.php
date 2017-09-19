<table >
    <thead>
    <tr class="weekdays">
        <th>{{__('machine.mnom')}}</th>
        <th>#</th>

    </tr>
    </thead>
    <tbody>



@foreach($machine_list as $machine)
    <tr class="days">
                <th>
                    {{ Form::label('machine['.$machine->id.'].selected',$machine->name, ['class' => 'control-label']) }}</th>
     <td>
         {{Form::checkbox('machine['.$machine->id.'].selected',$machine->id,['class'=>'u-full-width'])}}</td></tr>
    @endforeach
</table>
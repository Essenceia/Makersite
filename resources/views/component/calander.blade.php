<link rel="stylesheet" type="text/css" href="{{ asset('/css/calander.css') }}" />
<div class="row">
    <div class="six columns">
<div id="calander"  style="display: block;">
    <table >
        <thead>
        <tr class="weekdays">
            <th>{{(__('machine.hor'))}}</th>
            <th>{{__('calander.lundi')}}</th>
            <th>{{__('calander.mardi')}}</th>
            <th>{{__('calander.mercredi')}}</th>
            <th>{{__('calander.jeudi')}}</th>
            <th>{{__('calander.vendredi')}}</th>
        </tr>
        </thead>
        <tbody>
        {!! Form::open(array('class' => 'form-inline', 'method' =>'PUT','route' => array('defaultcalander.update',$data))) !!}
        @for($time=0; $time < 20 ; $time++)
            <tr class="days">
                <th>{{$elem[$time][0]->time}}</th>
                @foreach($elem[$time] as $horaire)
                    <td>
                       {{Form::checkbox('horaire'.$horaire->id,$horaire->time,($horaire->open? true:false))}}
                    </td>
                    @endforeach

            </tr>
            @endfor

        </tbody>
    </table>
</div></div>
        <div class="six columns">{{Form::token()}}
            <br><br>
            <p>{{(__('machine.calanderexplaination'))}}</p>
            {{ Form::submit((__('main.update')), array('class' => 'button u-full-width')) }}
            {!! Form::close() !!}
        </div>
    </div>

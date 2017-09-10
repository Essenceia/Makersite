
<div style="display: block;">
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
        @for($time=0; $time < 20 ; $time++)
            <tr class="days">
                <th>{{$elem[$time][0]->date}}</th>
                @for($day = 0 ; $day < 5 ; $day ++)
                    <td>
                        @if($elem[$time][$day]->status === 0)
                            <span class="closed">
                                <img src="{{asset('img/icon/closedred.svg')}}"  height="20rem" width="auto">
                            </span>
                        @endif
                        @if($elem[$time][$day]->status === 1)
                            <span class="ouvert">
                                                {{Form::checkbox('CalanderID[]', $elem[$time][$day]->id,false)}}
              </span>
                        @endif
                        @if($elem[$time][$day]->status  === 2)<span class="reserver"><img src="{{asset('img/icon/closedblue.svg')}}"  height="20rem" width="auto">
              </span>
                        @endif
                    </td>
                    @endfor

            </tr>
            @endfor

        </tbody>
    </table>
</div>



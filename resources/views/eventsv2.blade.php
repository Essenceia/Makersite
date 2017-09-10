@extends('layout')
@section('content')
<section class="header">
    <h2 class="title" id="pop">{{__('events.title')}}</h2>
</section>
<section class="docs-section" id="agenda">
    <div class="value-props row">
        <div class="eight columns value-prop">
            <iframe src="https://calendar.google.com/calendar/embed?showTitle=0&amp;
    showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;
    mode=WEEK&amp;height=600&amp;wkst=2&amp;hl=fr&amp;
    bgcolor=%23FFFFFF&amp;
    src=306e1clvb7f1s2m8pr8qd4tqro%40group.calendar.google.com&amp;
    color=%23182C57&amp;
    ctz=Europe%2FParis" style="border:solid 1px #777"
                    width="90%" height="300rem" frameborder="0" scrolling="no"></iframe>
        </div>
        <div class="four columns">
          {{__('events.timedesc')}}
        </div>
    </div>
    <br>
    <div class="row">
        <table class="u-full-width">
            <thead>
            <tr>
                <th>{{__('events.start')}}</th>
                <th>{{(__('events.end'))}}</th>
                <th>{{__('events.name')}}</th>
                <th>{{__('main.desc')}}</th>
                <th>{{__('events.nspots')}}</th>
                <th>{{__('events.res')}}</th>

            </tr>
            </thead>
            <tbody>
            @if(empty($event))
                <tr>
                    <p>{{__('events.empty')}}</p>
                </tr>
                @else
                @foreach($event as $date)
                    <tr>

                        <td>{{$date->start_time}}</td>
                        <td>{{$date->end_time}}</td>
                        <td>{{$date->name}}</td>
                        <td>{{$date->title}}</td>
                        <td>{{$date->open_spots}}  {{__('events.spots')}}</td>
                        <td>@if($date->open_spots>0)
                                {!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' => array('event_reserve.edit', $date->id))) !!}
                                {{Form::token()}}
                                {{Form::hidden('id',$date->id)}}
                                {{ Form::submit('Reserver', array('class' => 'button-primary')) }}
                                {!! Form::close() !!}

                        @else
                                <div class="row">
                                    <p>{{__('events.slotscolsed')}}</p>
                                    <input class="button" value="Fermer" type="submit"></div>
                        @endif</td>

                    </tr>
                    @endforeach
                @endif

            </tbody>
        </table>

    </div>
</section>
@endsection
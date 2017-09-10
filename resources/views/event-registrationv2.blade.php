@extends('layout')
@section('content')
    <section class="header">
        <h2 class="title">{{$event->name}}</h2>

    </section>
    <div class="row">
        <div class="six columns">
            <p>{{$event->start_time}}
                <br>
            {{$event->title}}
            <br>
            places restantes : {{$event->open_spots}}</p>


        </div>
        <div class="six columns">
            @if($blacklist==false)
            {!! Form::open(array('class' => 'form-inline', 'method' => 'PUT', 'route' => array('event_reserve.update', $event->id))) !!}
            {{Form::token()}}
            {{Form::hidden('id',$event->id)}}
                {{ Form::submit('Reserver', array('class' => 'button-primary')) }}
                {!! Form::close() !!}
                @else
                    <p class="alert">Tu est blacklister, pardon mais il ne t'est pas possible de reserver en ce moment et ce pendant une semaine suivant le blacklisting.</p>
                @endif
        </div>
    </div>
    @endsection
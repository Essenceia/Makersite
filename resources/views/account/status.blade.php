@extends('layout')
@section('content')
<style>
    .status{
        color: #737373;
    }
    .info{
        display: inline-block;
        color: #250f7e;
    }
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('/css/calander.css') }}" />

    <section class="header">

        <div class="row">
            @if(Auth::user()->is_leader)<div class="four columns">@else<div class="six columns">@endif
                <p>
                    <!-- User id -->
                <div class="status">{{__('account.nom')}} : <div class="info">{{Auth::user()->name}}</div> </div>
                <div class="status"> {{__('account.mail')}} : <div class="info">{{Auth::user()->email}}</div></div>
                </p>
            </div>
            @if(Auth::user()->is_leader)
                    <p>
                    <div class="status">{{__('account.nomprojet')}} : <div class="info">{{$projet->name}}</div></div>
                    <div class="status">{{__('account.creditprojet')}}: <div class="info">{{$projet->points}}</div></div>

                    </p>
                <div class="four columns ">
                    @else
                        <div class="six columns">
                            @endif
                                                    <p>
                                <div class="status">{{__('account.statu')}} : <div class="info">{{__('account.statu'.Auth::user()->status)}}</div></div>
                                <div class="status"> {{__('account.credit')}} : <div class="info">{{Auth::user()->points}} </div></div>

                                </p>
                       </div>
    <section class="row">
        <div class="six columns" style="display: block;">
            <table class="u-full-width">
                <thead class="weekdays">
                <tr>
                    <th>{{__('machine.mnom')}}</th>
                    <th>{{__('main.desc')}}</th>
                    <th>{{__('machine.mstart')}}</th>
                </tr>
                </thead>
                <tbody class="days">
                @foreach($resamachine as $r)
                <tr>
                    <td>{{$r->mname}}</td>
                    <td>{{$r->mdesc}}</td>
                    <td>{{$r->mtime}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="six columns" style="display: block;">
            <table class="u-full-width">
                <thead class="weekdays">
                <tr>
                    <th>{{__('events.name')}}</th>
                    <th>{{__('main.desc')}}</th>
                    <th>{{__('events.start')}}</th>
                    <th>{{__('events.end')}}</th>
                </tr>
                </thead>
                <tbody class="days">
                @foreach($resaevent as $r)
                    <tr>
                        <td>{{$r->ename}}</td>
                        <td>{{$r->edesc}}</td>
                        <td>{{$r->estart}}</td>
                        <td>{{$r->eend}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <div class="row">
        {!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' =>'mail.create')) !!}
        {{Form::token()}}
        {{ Form::submit((__('mail.contactadmin')), array('class' => 'button-primary u-full-width')) }}
        {!! Form::close() !!}
    </div>


@endsection
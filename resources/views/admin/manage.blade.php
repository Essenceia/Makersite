@extends('layout')
@section('content')

    @if(Auth::user()->status>1)
        <!-- Events -->
        <br>
        <div class="row">
            <div class="four columns">
                <h1>{{(__('manage.event'))}}</h1>
            </div>
            <div class="eight columns">{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' =>'events.create')) !!}
                {{Form::token()}}
                {{ Form::submit((__('main.creat')), array('class' => 'button-primary u-full-width')) }}
                {!! Form::close() !!}</div>
        </div>
        @component('component.eventlist')
            @slot('list',$events)
        @endcomponent
        <br>
        <!-- Blacklistst -->
        @component('admin.component.1buttonedit')
            @slot('title',(__('manage.blacklist')))
            @slot('routename','blacklist')
        @endcomponent
        <br>
        @component('admin.component.2buttoncreateedit')
            @slot('title',(__('main.navfaq')))
            @slot('routename','faq')
        @endcomponent
        <br>




        @if(Auth::user()->status>2)
            <!-- points par default -->
            @component('admin.component.1buttonedit')
                @slot('title',(__('defaultpoints.defpointstitle')))
                @slot('routename','points_default')
            @endcomponent
            <!--projet-->
            <div class="row">
                <div class="four columns">
                    <h1>{{(__('project.creatproject'))}}</h1>
                </div>
                <div class="eight columns">{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' =>'parse_project.create')) !!}
                    {{Form::token()}}
                    {{ Form::submit((__('main.creat')), array('class' => 'button-primary u-full-width')) }}
                    {!! Form::close() !!}</div>
            </div>


            <!-- utilisateurs -->
            @component('admin.component.1buttonedit')
                @slot('title',(__('manage.users')))
                @slot('routename','account')
            @endcomponent
            <br>

            @component('admin.component.2buttoncreateedit')
                @slot('title',(__('manage.machtype')))
                @slot('routename','machinetype')
            @endcomponent
            <br>

            <div class="row">
                <div class="four columns">
                    <h1>{{(__('manage.machine'))}}</h1>
                </div>
                <div class="eight columns">
                    {!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' =>'machine.create')) !!}
                    {{Form::token()}}
                    {{ Form::submit((__('main.creat')), array('class' => 'button-primary u-full-width')) }}
                    {!! Form::close() !!}
                </div>
            </div>


            @component('component.machinelist')
                @slot('list',$machines)
            @endcomponent

            <div class="row"><div class="four columns">{{(__('reservation.resamachine'))}}</div><div class="eight columns">{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' =>'machine_reservation.index')) !!}
                    {{Form::token()}}
                    {{ Form::submit((__('reservation.resalist')), array('class' => 'button-primary u-full-width')) }}
                    {!! Form::close() !!}</div> </div>
        @endif

    @endif
@endsection
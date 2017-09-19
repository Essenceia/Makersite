<br>
{!! Form::open(array('class' => 'form-inline', 'method' => 'PUT', 'route' =>array('machine_special_event.update',$data['id']))) !!}
{{Form::token()}}
<div class="row">
    <div class="twelve columns">
        {{ Form::label('eventname', (__('calander.eventname')), ['class' => 'control-label']) }}
        {{Form::text('eventname',"",['class'=>'u-full-width'])}}
    </div>
</div>
<div class="row">
    <div class="twelve columns">
        {{ Form::label('eventdesc', (__('calander.eventdesc')), ['class' => 'control-label']) }}
        {{Form::text('eventdesc',"",['class'=>'u-full-width'])}}
    </div>
</div>
<br>
<div class="row">
<div class="six columns">
    @component('component.calander')
        @slot('elem',$elem)
        @endcomponent
</div>
<div class="six columns">
<!-- start dates -->
    <div class="row">
        @component('component.calander.dateselection')
            @slot('date_list',$data['date'])
            @endcomponent
    </div>

    <!-- machine selection list all machines-->
    <div class="row ">
    @component('component.calander.machineselection')
        @slot('machine_list',$data['machine'])
        @endcomponent</div>


    <!-- Save -->
    <div class="row">
        {{ Form::submit((__('main.creat')), array('class' => 'button-primary u-full-width')) }}
        {!! Form::close() !!}
    </div>
</div>
</div>


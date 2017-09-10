<link rel="stylesheet" type="text/css" href="{{ asset('/css/calander.css') }}" />


{!! Form::open(array('class' => 'form-inline', 'method' => 'PUT', 'route' =>array('machine_reservation.update',$data->id))) !!}
<div class="row">
    <div class="six columns">
        <h6><strong>{{(__('calander.thisweek'))}}</strong></h6>

@component('component.calandermachine')
    @slot('elem',$elem[0])
    @endcomponent
        <h6><strong>{{(__('calander.nextweek'))}}</strong></h6>
@component('component.calandermachine')
    @slot('elem',$elem[1])
@endcomponent
    </div>
    <div class="six columns">
        <h6>{{(__('calander.resa'))}}
            <strong>{{$data->name}}</strong></h6>
        {{ Form::label('desc', 'Description') }}
        {{ Form::textarea('desc','Ce creneaux vas etre utiliser pour ...',['class'=>'form-control', 'rows' => 8, 'cols' => 30]) }}
        <div class="row">
            <div class="twelve columns">{{Form::checkbox('verified',1,false)}} {{(__('calander.verified'))}}</div>

        </div>
        <div class="row">
            <div class="twelve columns">{{Form::checkbox('engage',1,false)}} {{(__('calander.engcond'))}}</div>

        </div>
    @if(Auth::user()->is_leader)
           <div class="row">
               <div class="twelve columns">{{Form::checkbox('is_project',1,false)}} {{(__('calander.forproj'))}} </div>

           </div>

    @endif

        {{ Form::submit((__('calander.validres')), array('class' => 'button-primary u-full-width')) }}
{{ Form::close() }}
    </div>
</div>
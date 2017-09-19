<div class="row">
    <div class="six columns">
        {!! Form::open(array('class' => 'form-inline', 'method' =>'PUT','route' => array('defaultcalander.update',$data))) !!}
        @component('component.calander')
            @slot('elem',$elem)
        @endcomponent
    </div>
    <div class="six columns">
        <div class="six columns">{{Form::token()}}
            <br><br>
            <p>{{(__('machine.calanderexplaination'))}}</p>
            {{ Form::submit((__('main.update')), array('class' => 'button u-full-width')) }}
            {!! Form::close() !!}
        </div>
    </div>
</div>

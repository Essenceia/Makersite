{!! Form::open(array('class' => 'form-inline', 'method' => 'PUT', 'route' =>array('validate_registration.update',$elem->email))) !!}
{{Form::token()}}
<section class="header">

    <h5 class="title"> {{ Form::label('token', (__('registration.entertoken')), ['class' => 'control-label']) }}</h5>
    {{ Form::text('token', "") }}
    <br>
    {{ Form::submit((__('registration.validate')), array('class' => 'button-primary ')) }}


</section>
{!! Form::close() !!}
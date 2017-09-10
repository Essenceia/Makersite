<title>

</title>
<h4>
<div class="row">
    <div class="six columns">{{(__('project.name'))}}</div>
    <div class="six columns">{{$elem->name}}</div>
</div>
<div class="row">
    <div class="six columns">{{(__('project.code'))}}</div>
    <div class="six columns">{{(__('project.type'.$elem->type)).' '.$elem->number}}</div>
</div>
<div class="row">
    <div class="six columns">{{(__('account.creditprojet'))}}</div>
    <div class="six columns">{{$elem->points}}</div>
</div>
    <br>
<div class="row">
    <div class="six columns">{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' =>array('projet.edit',$elem->id))) !!}
        {{Form::token()}}
        {{ Form::submit((__('main.edit')), array('class' => 'button-primary u-full-width')) }}
        {!! Form::close() !!}</div>
    <div class="six columns">{!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' =>array('projet.destroy',$elem->id))) !!}
        {{Form::token()}}

        {{ Form::submit((__('main.sup')), array('class' => 'button-primary u-full-width')) }}
        {!! Form::close() !!}</div>
</div>
</h4>

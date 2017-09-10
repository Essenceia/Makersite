<br>
{!! Form::open(array('class' => 'form-inline', 'method' => 'PUT', 'route' =>array('points_default.update',$elem->id))) !!}
{{Form::token()}}
<h5>{{(__('defaultpoints.perprojecttype'))}}</h5>
<div class="row">
    <div class="four columns">
        {{ Form::label('pt0', (__('project.type0')), ['class' => 'control-label']) }}
        {{Form::number('pt0',$elem->project_type0,['class'=>'u-full-width'])}}
    </div><div class="four columns">
        {{ Form::label('pt1', (__('project.type1')), ['class' => 'control-label']) }}
        {{Form::number('pt1',$elem->project_type1,['class'=>'u-full-width'])}}
    </div><div class="four columns">
        {{ Form::label('pt2', (__('project.type2')), ['class' => 'control-label']) }}
        {{Form::number('pt2',$elem->project_type2,['class'=>'u-full-width'])}}
    </div>

</div>
<br>
<h5>{{(__('defaultpoints.perusertype'))}}</h5>
<div class="row">
    <div class="three columns">
        {{ Form::label('ut0', (__('account.statu0')), ['class' => 'control-label']) }}
        {{Form::number('ut0',$elem->user_type0,['class'=>'u-full-width'])}}
    </div>
    <div class="three columns">
        {{ Form::label('ut1', (__('account.statu1')), ['class' => 'control-label']) }}
        {{Form::number('ut1',$elem->user_type1,['class'=>'u-full-width'])}}
    </div>
    <div class="three columns">
        {{ Form::label('ut2', (__('account.statu2')), ['class' => 'control-label']) }}
        {{Form::number('ut2',$elem->user_type2,['class'=>'u-full-width'])}}
    </div>
    <div class="three columns">
        {{ Form::label('ut3', (__('account.statu3')), ['class' => 'control-label']) }}
        {{Form::number('ut3',$elem->user_type3,['class'=>'u-full-width'])}}
    </div>
</div>
<br>
<div class="row">
    {{ Form::submit((__('main.update')), array('class' => 'button-primary u-full-width')) }}
    {!! Form::close() !!}
</div>

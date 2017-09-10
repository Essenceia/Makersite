
    <h4 class="title" id="pop">{{__('defaultpoints.title')}}</h4>
    <hr>
    <p>{{(__('defaultpoints.perprojecttype'))}}</p>
<div class="row">
    <div class="six columns">{{(__('project.type0'))}}</div>
    <div class="six columns">{{$elem->project_type0}}</div>
</div>
    <div class="row">
        <div class="six columns">{{(__('project.type1'))}}</div>
        <div class="six columns">{{$elem->project_type1}}</div>
    </div><div class="row">
        <div class="six columns">{{(__('project.type2'))}}</div>
        <div class="six columns">{{$elem->project_type2}}</div>
    </div>
    <hr>
    <p>{{(__('defaultpoints.perusertype'))}}</p>
    <div class="row">
        <div class="six columns">{{(__('account.statu0'))}}</div>
        <div class="six columns">{{$elem->user_type0}}</div>
    </div>
    <div class="row">
        <div class="six columns">{{(__('account.statu1'))}}</div>
        <div class="six columns">{{$elem->user_type1}}</div>
    </div>
    <div class="row">
        <div class="six columns">{{(__('account.statu2'))}}</div>
        <div class="six columns">{{$elem->user_type2}}</div>
    </div>
    <div class="row">
        <div class="six columns">{{(__('account.statu3'))}}</div>
        <div class="six columns">{{$elem->user_type3}}</div>
    </div>

    <br>
<div class="row">
    <div class="twelve columns">{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' =>array('points_default.edit',$elem->id))) !!}
        {{Form::token()}}
        {{ Form::submit((__('main.edit')), array('class' => 'button-primary u-full-width')) }}
        {!! Form::close() !!}</div>

</div>


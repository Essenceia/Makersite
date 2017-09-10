{!! Form::open(array('class' => 'form-inline', 'method' => 'PUT', 'route' =>array('parse_project.update',1))) !!}
{{Form::token()}}
<table class="table">
<thead>
<tr>
    <th>#</th>
    <th>{{(__('project.name'))}}</th>
    <th>{{(__('main.desc'))}}</th>
    <th>{{(__('project.leaderemail'))}}</th>
</tr>
</thead>
<tbody>
{{$i =0 }}
@foreach($elem as $el)

    <tr>
        <th scope="row">{{Form::text('project['.$i.'][id]',$el[0])}}</th>

        <td>{{Form::text('project['.$i.'][name]',$el[1])}}</td>
        <td>{{Form::text('project['.$i.'][desc]',$el[2])}}</td>
        <td>{{Form::text('project['.$i.'][mail]',$el[3])}}</td>
    </tr>
    {{$i++}}
    @endforeach
</tbody></table>

<br>
{{ Form::submit((__('main.update')), array('class' => 'button-primary u-full-width')) }}
{!! Form::close() !!}
<!-- show existing dates -->
<script type = "text/javascript"
        src = "{{ asset('/js/specialcalandercreation.js') }}"></script>
<table >
    <thead>
    <tr class="weekdays">
        <th>{{__('calander.startcalanderdate')}}</th>
        <th>{{__('main.sup')}}</th>
    </tr>
    </thead>
    <tbody>


@if(empty($date_list)==false)
    @foreach($date_list as $date)
        <tr class="days" id="datelist">
            <th>
                {{ Form::label('date['.$date->id.'][selected]',$date->monday_week_date, ['class' => 'control-label','id'=>$date->id]) }}</th>
            <td>
                {{Form::checkbox('machine['.$date->id.'][selected]',$date->id,['class'=>'u-full-width'])}}</td>
        </tr>
    @endforeach
    @endif
</table>
<input type="datetime" name="newadddate" value="{{date("Y-m-d")}}">
<input type="button" class="button-primary" id="adddate" value="{{__('calander.adddate')}}" >
<!-- option to add new dates -->

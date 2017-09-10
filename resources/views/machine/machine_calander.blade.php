{{-- get machine id to show calander , returned by routes calander
TODO : get time selected with id--}}
@extends('layout')
@section('content')
<script src="{{URL::asset("/js/form_calander.js")}} " ></script>
<script src="{{URL::asset("/js/form.js")}} " ></script>

<link rel="stylesheet" type="text/css" href="{{ asset('/css/calander.css') }}" />

        <div class="row">
                <h4>Reservation de Machine</h4><h5>{{$mname}}</h5></div>
{{ Form::open(array('url' => 'machine/reserver','method'=>'POST')) }}
            {{Form::token()}}
{{ Form::hidden('id', $machine_id) }}
{{ Form::hidden('mname', $mname) }}

        <div class="row">

            <div class="nine columns">
                <div class="row">
                    <label for="descriptionMessage">Veuillez selectionner vos hoiraire</label><a class="button" onclick="otherweek()">autre semaine</a></div>
                <div id="calander1" style="display: block;">
                    <?php $weeknumber = 0; ?>
                    <table>
                        <ul class="weekdays">
                            <li>
                                Lundi
                            </li>
                            <li>Mardi</li>
                            <li>Mercredi</li>
                            <li>Jeudi</li>
                            <li>Vendredi</li>
                        </ul>
                        <?php $count = 0;?>


                        @for($weeksize = 0 ;$weeksize < count($data[$weeknumber][0]);$weeksize++)
                                <ul class="days">
                                    @for($day = 0 ; $day <count($data[$weeknumber]) ; $day ++ )

                                    <li>
                                        @if($data[$weeknumber][$day][$weeksize]->status == 0)
                                            {{$data[$weeknumber][$day][$weeksize]->date}}
                                        @endif
                                        @if($data[$weeknumber][$day][$weeksize]->status === 1)
                                            <span class="ouvert">
                                                {{Form::checkbox('CalanderID[]', $data[$weeknumber][$day][$weeksize]->id)}}
                                                {{$data[$weeknumber][$day][$weeksize]->date}}
              </span>
                                        @endif
                                        @if($data[$weeknumber][$day][$weeksize]->status  === 2)<span class="reserver"> {{$data[$weeknumber][$day][$weeksize]->date}}
              </span>
                                        @endif
                                    </li>

                        @endfor
                            </ul>
                            @endfor


                    </table>
                </div>
                <div id="calander2" style="display: none;">

                    <?php $weeknumber = 1; ?>
                    <table>
                        <ul class="weekdays">
                            <li>
                                Lundi
                            </li>
                            <li>Mardi</li>
                            <li>Mercredi</li>
                            <li>Jeudi</li>
                            <li>Vendredi</li>
                            <li>Samedi</li>
                            <li>Dimanche</li>
                        </ul>
                        <?php $count = 0;?>


                        @for($weeksize = 0 ;$weeksize <5;$weeksize++)
                            <ul class="days">
                                @for($day = 0 ; $day <count($data[$weeknumber]) ; $day ++ )

                                    <li>
                                        @if($data[$weeknumber][$day][$weeksize]->status === 0)
                                            {{$data[$weeknumber][$day][$weeksize]->date}}
                                        @endif
                                        @if($data[$weeknumber][$day][$weeksize]->status === 1)
                                            <span class="ouvert">
                                                {{Form::checkbox('CalanderID', '$data[$weeknumber][$day][$weeksize]->id')}}
                                                {{$data[$weeknumber][$day][$weeksize]->date}}
              </span>
                                        @endif
                                        @if($data[$weeknumber][$day][$weeksize]->status  === 2)<span class="reserver"> {{$data[$weeknumber][$day][$weeksize]->date}}
              </span>
                                        @endif
                                    </li>

                                @endfor
                            </ul>
                        @endfor


                    </table>
                </div>
            </div>
            <div class="three columns">
                <div class="row">
                    {{ Form::label('desc', 'Description') }}
                                        {{ Form::textarea('desc','Ce creneaux vas etre utiliser pour ...',['class'=>'form-control', 'rows' => 8, 'cols' => 30]) }}
                </div>
                <div class="row">
                    {{Form::label('engage','Je m\'engage a utiliser ce creneau')}}
                    {{Form::checkbox('engage',0,false)}}
                </div>
                @if(Auth::user()->is_leader)
                <div class="row">
                    {{Form::label('is_project','Ceci est pour notre PPE/PSE/PFE')}}
                    {{Form::checkbox('is_project',0,false)}}
                </div>
                @endif
                <div class="row">

                    {{ Form::submit('Reserver', array('class' => 'button-primary')) }}

                </div>
            </div>




        </div>
        {{ Form::close() }}
@endsection
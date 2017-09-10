@extends('layout')
@section('content')
    <script type="text/javascript" src="{{ asset('/js/showbutton.js') }}"></script>

    <div class="docs-sections" id="short_into">
        <h5>{{__('machine.introtitre')}}</h5>
        <p> {{__('machine.introdesc')}}</p>
    </div>

    <!-- set variables -->
    <div class="docs-section" id="cathegories">

        @foreach($type as $t)
            <button class="u-full-width" id="{{"machinetype".$t->id}}">{{ $t->name }}</button>

            <div id="{{"typeid".$t->id}}" style="display:none">
                <div class="row"><div class="one column"></div>
                    <div class="ten columns"><p>{{$t->desc}}</p></div>
                    <div class="one column"></div> </div>
                <div class="row">
                @foreach($mlist[$t->id] as $machine)
                    <div class="four columns value-prop">
                        @include('machine.machineview',['type'=> $machine->type ,'id'=>$machine->id,'legend'=>$machine->desc,'name'=>$machine->name])
                    </div>

        @endforeach
                </div>
            </div>
        @endforeach
    </div>



@endsection


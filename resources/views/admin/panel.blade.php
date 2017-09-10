@extends('layout')
@section('content')
    @component('component.errors')
        @slot('errors',$errors)
        @endcomponent
    <div class="u-full-width">
    @component('component.'.$component)
    @if(isset($elem))
                @slot('elem',$elem)
            @endif
        @if(isset($data))
            @slot('data',$data)
            @endif
        @endcomponent
    </div>

    @endsection
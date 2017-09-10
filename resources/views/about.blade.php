@extends('layout')
@section('content')

@include('about/endroit')
    @include('about/fonct')

@foreach($team as $member)
    @if($date!=$member->year)
        {{$date = $member->year}}
        <hr>
        <div class="header">{{$date}}</div>
        @endif
    @include('about/equipe',['member'=>$member])

@endforeach
    @endsection
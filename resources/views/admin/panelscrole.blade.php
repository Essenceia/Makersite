@extends('layout')
@section('content')
    @component('component.errors')
        @slot('errors',$errors)
    @endcomponent
    <h2>{{__('main.pagenum').$pagenumber}}</h2>
    <div class="row">
        @component('component.userslist')
            @slot('elem',$elem)
            @endcomponent
    </div>

    <div class="row">
        <div class="four columns"></div>
        @component('component.chgpagebutton')
            @slot('route','account.index')
            @slot('pagenumber',$pagenumber-1)
            @slot('txt',(__('main.prev')))
            @endcomponent
        @component('component.chgpagebutton')
            @slot('route','account.index')
            @slot('pagenumber',$pagenumber+1)
            @slot('txt',(__('main.next')))
        @endcomponent

        <div class="four columns"></div>
    </div>
    @endsection
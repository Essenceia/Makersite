@extends('layout')
@section('content')
    <section class="header">
        <h2 class="title" id="pop">{{$message}}</h2>
        <div class="row">
            <div class="eight columns">
                <br><br><p>{{$submessage}}</p></div>
           <div class="four columns">
               <table >
                   <thead>
                   <tr>
                       <th>{{(__('reservation.resatabletitle'))}}</th>

                   </tr>
                   </thead>
                   <tbody>
                       @foreach($timelist as $slots)
                           <tr>
                           <td>{{$slots}}</td>
                           </tr>
                       @endforeach
                   </tbody>
               </table>
           </div>

        </div>
        <a class="button button-primary" id="pop"
           href="/" >{{(__('main.gotomenu'))}}</a>

    </section>
    @endsection
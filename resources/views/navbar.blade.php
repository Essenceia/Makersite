<style>
    ul > li{
        display: inline;
        float: left;
    }
</style>
<nav class="navbar u-full-width">
        <ul class="navbar-list row" style="display: inline-block">
            <li class="navbar-item"><a class="navbar-link" href="/">
                    <img src="{{URL::asset("img/logo.jpg")}}">></a></li>
            <li class="navbar-item"><a class="navbar-link" href="{{ route('machine.index') }}">{{__('main.navmachine')}}</a></li>
            <li class="navbar-item"><a class="navbar-link" href="{{ route('events.index') }}">{{__('main.navevents')}}</a></li>
            <li class="navbar-item"><a class="navbar-link" href="{{ url('about') }}">{{__('main.navabout')}}</a></li>
            <li class="navbar-item"><a class="navbar-link" href="{{ route('faq.show',1) }}">{{__('main.navfaq')}}</a></li>
            @if (Auth::guest())
                <li class="navbar-item"><a class="navbar-link" href="{{ route('login') }}">{{__('main.navlogin')}}</a></li>
                <li class="navbar-item"><a class="navbar-link" href="{{ route('validate_registration.create') }}">{{__('main.navregister')}}</a></li>
            @else
                @if(Auth::user()->status > 1)
                    <li class="navbar-item"><a class="navbar-link" href="{{ url('manage') }}">{{__('main.navmanage')}}</a></li>
                    @endif

                <li class="navbar-item">
                    <a href="{{route('account.show',[Auth::user()->id])}}" method="GET" class="navbar-link" role="button" >
                        {{ __('main.account')}}
                    </a></li>

                        <li class="navbar-item">
                            <a class="navbar-link" href="{{ route('logout') }}" >
                                {{__('main.navlogout')}}
                            </a>


                        </li>

            @endif

        </ul>
</nav>
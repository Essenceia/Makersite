<!-- template de base pour la
reservation des machines -->

<div class="four columns value-prop">
    <img src="{{URL::asset('img/'.$name.".jpg")}}" width="100rem" height="100rem">
    <p onclick="toggleview('{{$name.$id}}')"> {{$name }}</p>
    <p style="display: none;" id="{{$name.$id}}">{{$legend}}</p>
    <a class="button button-primary"
    type="submit" href="{{ route('machine/reserver', $id) }}" id={{ $id }}>Reserver</a>
</div>

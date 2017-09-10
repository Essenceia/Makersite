<br>
<script text="text/javascript" src="{{asset('/js/faq.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('/css/faq.css')}}">
<h2>{{(__('faq.title'))}}</h2>

@foreach($elem as $question)
    @component('component.faqquestion')
    @slot('question',$question->question)
    @slot('awnser',$question->awnser)
    @endcomponent


    @endforeach
<br>
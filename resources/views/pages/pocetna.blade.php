@extends('layout.layout')

@section('title')
Pocetna
@endsection
@section('content')
    <header class="py-5 bg-image-full">
        <img id='pocetna' src="{{asset('/')}}img/head.jpg"/>
    </header>

      <div  class="row">
      <div class="container">
        <h1>Vodič kroz Španiju</h1>
        <p class="lead">Zanimljive španske destinacije</p>
        <p>
        Španija je jedna od najlepših zemalja na svetu sa milionima turista godišnje
        i sa jednim od najvećih prihoda od turizma.</br>
        Ukoliko vas interesuju zanimljivosti o Španiji i šta je to što čini ovu zemlju tako interesantnom,
        pogledajte neke od neobičnih </br> destinacija i informacija koje vam donosimo vezano za ovu zemlju.</br>
        Da li vi znate još neke zanimljivosti?
        </p>
   
        @if(session()->has('kor'))
           <section class="py-5">
            <h5 class="card-header text-center">Anketa</h5>
            <div class="py-4">
              <div class="input-group">
                <div id='anketa'>
                    <div class="container">
                   @include('components.anketa')
                    </div>
               </div>
            </div>
        @endif
           </div>
    </section>
      </div>
     
@endsection

@section('js')
@parent
<script type="text/javascript" src="{{ asset('js/ajax.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/provera.js') }}"></script>

@endsection
@extends('layout.layout')

@section('title')
Drugi korisnik
@endsection

@section('content')
<div class="container">
   
    <div class="container">
        <p>Profil korisnika <b>{{$drugiKorisnik->ime}}</b></p>
     
      @isset($destinacije)
        @foreach($destinacije as $d)
      
      <!-- Project One -->
      <div class="row">
        <div class="col-md-7">
          <a href="">
            <img class="img-fluid rounded mb-3 mb-md-0" src="{{ asset($d->putanja) }}" alt="{{ asset($d->alt) }}">
          </a>
        </div>
        <div class="col-md-5">
           <h3>{{ $d->naslov }}</h3>
          <p>{{ $d->opis }}</p>
          <a class="btn btn-primary" href="{{asset('/destinacija/'.$d->idPost)}}">Detaljnije</a>
        </div>
      </div>
      </br>
      <hr>
    @endforeach
@endisset
      <hr>
      
</div>
    
    
    
    
    
    
    
      
</div>
@endsection
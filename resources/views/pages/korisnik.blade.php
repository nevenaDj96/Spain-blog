@extends('layout.layout')
@section('title')
Korisnik
@endsection

@section('content')

<div id='korisnik'> 
<div class="container">
     @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
       
            @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
                
            @endif
            
            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
                
            @endif
            
      <h3 class="my-4">Dobrodošli, {{$korisnik->ime}}.
      </h3>
      <a class="btn btn-primary" href="{{ route('dodavanjePostova') }}">Dodaj post</a><br/><br/>
      @isset($destinacije)
        @foreach($destinacije as $d)
      <!-- Project One -->
      <div class="row">
        <div class="col-md-7">
           <img class="img-fluid rounded mb-3 mb-md-0" src="{{ asset($d->putanja) }}" alt="{{ $d->alt }}">
        </div>
        <div class="col-md-5 recept" >
          <a href="{{asset('/destinacija/'.$d->idPost)}}"><h3>{{ $d->naslov }}</h3></a>
          <p>{{$d->opis}}</p>
         <a class="btn btn-primary" href="{{route('izmenaPostova', ['id' => $d->idPost])}}">Izmena</a>
         <a class="btn btn-primary" href="{{route('brisanje', ['id' => $d->idPost])}}">Brisanje</a>
        </div>
      </div><br/>
     
        @endforeach
      @endisset
      
      <hr>
      
</div>
</div>



@endsection


@extends('layout.layout')

@section('title')
Destinacije
@endsection

@section('content')

  
<!-- Page Content -->
<div id="destinacija">
   
<div class="container">

<div class="row">
         
    @isset($destinacija) 
          
        <!-- Post Content Column -->
        <div class="col-lg-8">
             
          <!-- Title -->
          <h1 class="mt-4">{{$destinacija->naslov}}</h1>

          <!-- Author -->
          <p class="lead">
            Objavio/la:
            
               @if(session()->has('kor'))
            
                <a href="{{(session('kor')[0]->idKorisnik == $destinacija->idKorisnik)? route('korisnik') : route('drugiKorisnik', ['id' => $destinacija->idKorisnik]) }}" >{{$destinacija->ime}}</a>
                 <br/>
              @endif 
                  @if(!session()->has('kor'))
            
                <a href="{{route('drugiKorisnik', ['id' => $destinacija->idKorisnik])}}" >{{$destinacija->ime}}</a>
                 <br/>
              @endif 
              
          </p>

          <hr>

          <!-- Date/Time -->
          <p class="lead">Datum: {{ date('d.m.Y.', strtotime($destinacija->datum_kreiranja)) }}</p>

          <hr>

          <!-- Preview Image -->
          <img class="img-fluid rounded" src="{{ asset($destinacija->putanja) }}" alt="{{ $destinacija->alt }}">
          
          
          
          <hr>

          <!-- Post Content -->
          

          <blockquote class="blockquote">
              <p class="lead">{{ $destinacija->opis }}</p>
          </blockquote>
          
          <hr>
          
          <p>{{$destinacija->sadrzaj}}</p>
          
          <hr>
          
          @isset($komentari)
          
          @if($komentari->count() > 0)
          
          <!-- Single Comment -->
          <h4>Komentari:</h4>
          @foreach($komentari as $k)
          
           
          <div class="media mb-4" style="border-bottom: 2px solid gray;border-radius:5px;padding:25px;">
                 
            <div class="media-body">
              <h5 class="mt-0">{{$k->ime}}</h5>
              {{$k->komentar}}
            </div>
               <p>{{ date('d.m.Y.', strtotime($k->datum_kreiranja)) }}&nbsp;&nbsp;</p>
               
               @if(session()->has('kor'))
                @if((session('kor')[0]->idKorisnik == $k->idKorisnik) ||  ($destinacija->idKorisnik == session('kor')[0]->idKorisnik))
                    <a href="{{route('izbrisiKomentar',['id'=>$k->idKomentar])}}">&nbsp;&nbsp;izbriši&nbsp;&nbsp;</a>
                    
                 @endif
                 
               @endif
               
          </div>
                
           @endforeach 
           
           @endif
          
          @endisset
           @if(session()->has('kor'))
          
          <!-- Comments Form -->
          <div class="card my-4">
            <h5 class="card-header">Ostavite komentar:</h5>
            <div class="card-body" >
              <form  action="{{route('dodajKomentar')}}" method="post">
                  {{ csrf_field() }}
                <div class="form-group"  >
                  <input type="hidden" name="idPost" value="{{$destinacija->idPost}}"/>
                  <textarea  id="komentarText" class="form-control" rows="3" name="komentar" required="true"></textarea>
                </div>
                <button id="komentarBtn" type="submit" class="btn btn-primary">Komentariši</button>
              </form>
            </div>
          </div>
          @endif
          <hr/>
          
        </div>
        @endisset
</div>
</div>
</div>

@endsection
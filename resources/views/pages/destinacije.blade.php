@extends('layout.layout')

@section('title')
Destinacije
@endsection

@section('content')
<div id='korisnik'>
<div id="kategorije">
    
    <div class="container">
        <div class="row">
            
            
            <form class="form-group">
                
                <select name="kategorije" class="form-control"  onchange="promeniKategoriju(this.value)" >
                    <option value="0">Izaberite grad...</option>
                    @isset($kategorije)
                    
                    @foreach($kategorije as $k)
                    
                    <option value="{{$k->idKategorije}}">{{$k->grad}}</option>
                    
                    @endforeach
                    
                    @endisset
                </select>
                
            </form>
            
        </div>
        
    </div>
    
</div>


<!-- PRIKAZANO PREKO AJAXA -->

  <!--  
@isset($destinacije)
 @foreach($destinacije as $d)

 
      <div class="row">
        <div class="col-md-7">
          <a href="">
            <img class="img-fluid rounded mb-3 mb-md-0" src="{{ asset($d->putanja) }}" alt="{{ $d->alt }}">
          </a>
        </div>
        <div class="col-md-5">
          <h3>{{ $d->naslov }}</h3>
          <p>{{ $d->opis }}</p>
          <a class="btn btn-primary" href="{{ asset('/destinacija/'.$d->idPost)}}">View Project</a>
        </div>
            <div class="card-footer text-muted">
               Datum objavljivanja: {{ date('d.m.Y.', strtotime($d->datum_kreiranja)) }}</br>
               
               @if(session()->has('kor'))
               Kreirao/la : <a href="#">{{ $d->ime }}</a> </br>
               @endif
               Broj komentara: {{$d->brojKomentara}}
             </div>
          
      </div>
   @endforeach
   @endisset 
    -->
   
   <div id="postovi">
       
   </div>
   
     <hr>
 

     </div>
      <!-- /.row -->
    
     



@endsection

@section('js')
@parent
<script type="text/javascript">
    
    
    const token = '{{ csrf_token() }}';
    //console.log(token);
    
</script>
<script src="{{asset('/')}}js/ajax.js"></script>

@endsection
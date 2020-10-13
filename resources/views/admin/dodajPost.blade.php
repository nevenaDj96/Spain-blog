@extends('layout.layout')

@section('title')
Admin - dodavanje postova
@endsection


@section('content')

 @include('components.links')
<section class="py-7">
      <div class="container">
        <div class="wrapper">
        
            
            <div class="postovi">
                
                @include('components.alerts')
                <h4 class='text-center'>Dodavanje postova </h4></br></br>               
                <form class="form-control" method="POST" action="{{route('proveraDodavanjaPosta')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    
                        
                   <select name="gradovi" class="form-control" required="true" autofocus="">
                         <option value="0">Izaberite grad</option>
                    @isset($gradovi)
                    
                    @foreach($gradovi as $g)
                    
                    <option value="{{$g->idKategorije}}">{{$g->grad}}</option>
                    
                    @endforeach
                    
                    @endisset
                    </select><br/>
                    
                    
                    
                    
                    <input type="text" class="form-control" name="naslov" id="naslov" placeholder="Naziv grada" required="true" value="{{old('naslov')}}" /><br/>
                    <input type="text" class="form-control" name="opis" id="opis" placeholder="Opis" required="true"  value="{{old('opis')}}"/><br/>

                    <textarea rows="2" class="form-control" cols="40" name="sadrzaj" id="sadrzaj" placeholder="Sadrzaj">{{old('sadrzaj')}}</textarea>
                    <br/>
                    <input type="file" class="form-control" name="slika" id="slika" required="true"/>
                    <br/>
                    <input type="text" class="form-control" name="alt" id="alt" placeholder="Opis slike" required="true"  value="{{old('alt')}}"/><br/>

                     <input type="hidden" name="idKorisnik" value="{{session('kor')[0]->idKorisnik}}"/>

                    <button class="btn btn-lg btn-primary btn-block" type="submit">Dodajte post</button>  <br/>
                </form>
            </div>
        </div>
      </div>
    </section>






@endsection


@extends('layout.layout')

@section('title')
Dodavanje postova
@endsection


@section('content')

<section class="py-7">
      <div class="container">
        <div class="wrapper">
            
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
            
            <div class="postovi">
                <h4 class='text-center'>Dodavanje postova </h4></br></br>               
                <form class="form-control" method="POST" action="{{ route('proveraDodavanja')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    
                        
                   <select name="gradovi" class="form-control" required="true" autofocus="">
                         <option value="0">Izaberite grad</option>
                    @isset($gradovi)
                    
                    @foreach($gradovi as $k)
                    
                    <option value="{{$k->idKategorije}}">{{$k->grad}}</option>
                    
                    @endforeach
                    
                    @endisset
                    </select><br/>
                    
                    
                    
                    
                    <input type="text" class="form-control" name="naslov" id="naslov" placeholder="Naziv grada" required="true" value="{{old('naslov')}}" /><br/>
                    <input type="text" class="form-control" name="opis" id="opis" placeholder="Opis" required="true"  value="{{old('opis')}}"/><br/>

                    <textarea rows="2" class="form-control" cols="40" name="sadrzaj" id="sadrzaj" placeholder="Sadrzaj">{{old('sadrzaj')}}</textarea>
                    <br/>
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
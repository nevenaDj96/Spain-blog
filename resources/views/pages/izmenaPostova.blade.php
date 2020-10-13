@extends('layout.layout')

@section('title')
Izmena postova
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
                   @isset($izmena)
                <h4 class='text-center'>Izmena postova</h4></br></br>               
                <form class="form-control" method="POST" action="{{ route('proveraIzmenePOSTA')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    
                        
                   <select name="gradovi" class="form-control" required="true" autofocus="">
                         <option value="0">Izaberite grad</option>
                    @isset($gradovi)
                    
                    @foreach($gradovi as $g)
                    
                    <option value='{{$g->idKategorije}}' {{ ($g->idKategorije == $izmena->idKategorije)? 'selected' : '' }}>{{$g->grad}}</option>
                    
                    @endforeach
                    
                    @endisset
                    </select><br/>
                    
                    
                    
                 <input type="text" class="form-control" name="naslov" id="naslov" placeholder="Naziv grada" required="true" value="{{ $izmena->naslov }}" /><br/>
                            <input type="text" class="form-control" name="opis" id="opis" placeholder="Opis" required="true"  value="{{ $izmena->opis }}"/><br/>
                            <textarea rows="2" class="form-control" cols="40" name="sadrzaj" id="sadrzaj" placeholder="Sadrzaj">{{$izmena->sadrzaj}}</textarea>  
                            <br/>
                            <input type="file" class="form-control" name="slika" id="slika" />
                            <br/>
                            <input type="text" class="form-control" name="alt" id="alt" placeholder="Opis" required="true"  value="{{$izmena->alt}}"/><br/>
                            <input type="hidden" name="idKorisnik" value="{{session('kor')[0]->idKorisnik}}"/>
                            <input type="hidden" name="idPost" value="{{$izmena->idPost}}"/>

                            <button class="btn btn-lg btn-primary btn-block" type="submit">Izmenite</button><br/>
                        </form>
                @endisset
            </div>
        </div>
      </div>
    </section>






@endsection
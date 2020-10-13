@extends('layout.layout')

@section('title')
Admin - izmena postova
@endsection


@section('content')
@include('components.links')

<section class="py-7">
      <div class="container">
        <div class="wrapper">
        
            
            <div class="postovi">
                
                @include('components.alerts')
                  
                    @isset($izmena)
                <h4 class='text-center'>Izmena posta </h4></br></br>               
                <form class="form-control" method="POST" action="{{route('proveraIzmenePostaAdmin')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    
                        
                   <select name="gradovi" class="form-control" required="true" autofocus="">
                         <option value="0">Izaberite grad</option>
                    @isset($grad)
                    
                    @foreach($grad as $g)
                    
                    <option value="{{$g->idKategorije}}" {{($g->idKategorije == $izmena->idKategorije)? 'selected' : '' }}>{{$g->grad}}</option>
                    
                    @endforeach
                    
                    @endisset
                    </select><br/>
                    
                  
                    
                    <input type="text" class="form-control" name="naslov" id="naslov" placeholder="Naziv grada" required="true" value="{{$izmena->naslov}}" /><br/>
                    <input type="text" class="form-control" name="opis" id="opis" placeholder="Opis" required="true"  value="{{$izmena->opis}}"/><br/>
                    <textarea rows="2" class="form-control" cols="40" name="sadrzaj" id="sadrzaj" placeholder="Sadrzaj">{{$izmena->sadrzaj}}</textarea>
                    <br/>
                    <input type="file" class="form-control" name="slika" id="slika"/>
                    <br/>
                    <input type="text" class="form-control" name="alt" id="alt" placeholder="Opis slike" required="true"  value="{{$izmena->alt}}"/><br/>
                    
                     <input type="hidden" name="idKorisnik" value="{{session('kor')[0]->idKorisnik}}"/>
                       <input type="hidden" name="idPost" value="{{$izmena->idPost}}"/>
                        
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Izmenite post</button>  <br/>
                </form>
                @endisset
            </div>
        </div>
      </div>
    </section>






@endsection


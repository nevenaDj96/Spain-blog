@extends('layout.layout')

@section('title')
Admin - komentari

@endsection


@section('content')



 @include('components.links')
  
<div class="container">
    <div class="row">
        
        <div id='dodajMeni'> 
        
            
        
             <!-- Title -->
             <h2 class="mt-4 text-center">Komentari</h2>
                 @include('components.alerts')
                 
                  
          <table class="table">
              
              <tr>
                  <th>id</th>
                  <th>komentar</th>
                  <th>korisnik</th>
                  <th>vreme</th>
                  <th>izmena</th>
                 
                
              </tr>
               @isset($komentari)
                  @foreach($komentari as $k)
              <tr>
                    <td>{{$k->idKomentar}}</td>
                    <td>{{$k->komentar}}</td>
                    <td>{{$k->ime." ".$k->prezime }}</td>
                    <td>{{ date('d.m.Y. H:i:s', strtotime($k->vreme)) }}</td>
                    <td><a href="{{route('brisanjeKomentara',['id'=>$k->idKomentar])}}">obriši</a></td>
              </tr>
                         @endforeach
                          @endisset
             
          </table><hr><br/>

        </div> 
    </div>
</div>
@endsection
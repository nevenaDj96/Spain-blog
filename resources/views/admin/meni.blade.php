@extends('layout.layout')

@section('title')
Admin- meni

@endsection


@section('content')



 @include('components.links')
 
<div class="container">
    <div class="row">
        
        <div id='dodajMeni'> 
        
            
        
             <!-- Title -->
             <h2 class="mt-4 text-center">Meni</h2>
                 @include('components.alerts')
           
          @isset($meni)
          
          <table class="table">
              
              <tr>
                  <th>id</th>
                  <th>naziv</th>
                  <th>putanja</th>
                  <th>pozicija</th>
                  <th>izmena</th>
                  <th>brisanje</th>
                 <th><a class="btn btn-primary" href="{{route('dodajMeni')}}">Dodaj meni</a></th>
              </tr>
              @foreach($meni as $m)
              <tr>
                    <td>{{$m->idMeni}}</td>
                    <td>{{$m->naziv}}</td>
                    <td>{{$m->putanja}}</td>
                    <td>{{$m->pozicija}}</td>
                    <td><a href="{{route('izmeniMeni',['id' => $m->idMeni])}}">izmeni</a></td>
                  <td><a href="{{route('obrisiMeni',['id' => $m->idMeni])}}">obriši</a></td>
              </tr>
              
              @endforeach
          </table><hr><br/>
        @endisset
        </div> 
    </div>
</div>



@endsection

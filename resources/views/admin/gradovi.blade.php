@extends('layout.layout')

@section('title')
Admin - gradovi

@endsection


@section('content')



 @include('components.links')
 
<div class="container">
    <div class="row">
        
        <div id='dodajMeni'> 
        
            
        
             <!-- Title -->
             <h2 class="mt-4 text-center">Gradovi</h2>
                 @include('components.alerts')
           
         
          <table class="table">
        
              <tr>
                  <th>id</th>
                  <th>naziv</th>
                  <th><a class="btn btn-primary" href="{{route('dodajGrad')}}">Dodaj grad</a></th>
              </tr>
                     @isset($gradovi)
                 @foreach($gradovi as $g)
              <tr>
                    <td>{{$g->idKategorije}}</td>
                    <td>{{$g->grad}}</td>
                   
                    <td><a href="{{ route('izmenaGrada',['id' => $g->idKategorije] )}}">izmeni</a></td>
                  <td><a href="{{ route('brisanjeGrada',['id' => $g->idKategorije] )}}">obriši</a></td>
              </tr>
              
              @endforeach
          </table><hr><br/>
        @endisset
        </div> 
    </div>
</div>



@endsection

@extends('layout.layout')

@section('title')
Admin- meni izmena
@endsection


@include('components.links')
@section('content')
 <div class="container">
<div class="wrapper">
    
 @include('components.alerts')
 
<div id="dodajMeni">
  @isset($izmeni)
 <form class="form-control" id="dodajMeni" method="post" action="{{route('proveraIzmeneM')}}" >
 {{ csrf_field() }}

<h4 class="form-signin-heading">Izmeni meni</h4><br/>

<input type="text" class="form-control" name="naziv" id="naziv" placeholder="Naziv" required="true" value="{{$izmeni->naziv}}"/><br/>
<input type="text" class="form-control" name="putanja" id="putanja" placeholder="Putanja" required="true" value="{{$izmeni->putanja}}" /><br/>
<input type="text" class="form-control" name="pozicija" id="pozicija" placeholder="Pozicija" required="true" value="{{$izmeni->pozicija}}" /><br/>
<input type="hidden" name="idMeni" value="{{$izmeni->idMeni}}"/>
@endisset
<button class="btn btn-lg btn-primary btn-block" type="submit">Izmeni meni</button>  <br/>
 </form>
 </div>  
        </div>
 </div>
@endsection
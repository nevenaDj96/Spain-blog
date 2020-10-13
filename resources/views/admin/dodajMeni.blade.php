@extends('layout.layout')

@section('title')
Admin- meni dodavanje
@endsection


@include('components.links')
@section('content')
 <div class="container">
<div class="wrapper">
    
 @include('components.alerts')
 
<div id="dodajMeni">
   
 <form class="form-control" id="dodajMeni" method="post" action="{{route('proveraMeni')}}" >
 {{ csrf_field() }}

<h4 class="form-signin-heading">Dodaj meni</h4><br/>

<input type="text" class="form-control" name="naziv" id="naziv" placeholder="Naziv" required="true" value="{{old('naziv')}}" /><br/>
<input type="text" class="form-control" name="putanja" id="putanja" placeholder="Putanja" required="true" value="{{old('putanja')}}" /><br/>
<input type="text" class="form-control" name="pozicija" id="pozicija" placeholder="Pozicija" required="true" value="{{old('pozicija')}}" /><br/>
<button class="btn btn-lg btn-primary btn-block" type="submit">Dodaj meni</button>  <br/>
 </form>
 </div>  
        </div>
 </div>
@endsection
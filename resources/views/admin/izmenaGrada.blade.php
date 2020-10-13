@extends('layout.layout')

@section('title')
Admin- gradovi izmena
@endsection


@include('components.links')
@section('content')
 <div class="container">
<div class="wrapper">
    
 @include('components.alerts')
 
<div id="dodajMeni">
   
 <form class="form-control" id="dodajMeni" method="post" action="{{route('proveraIzmeneGrada')}}" >
 {{ csrf_field() }}

<h4 class="form-signin-heading">Izmeni grad</h4><br/>
@isset($izmena)
<input type="text" class="form-control" name="grad" id="grad" placeholder="Naziv grada" required="true" value="{{$izmena->grad}}" /><br/>
<input type="hidden" name="idKategorije" value="{{$izmena->idKategorije}}"/>
<button class="btn btn-lg btn-primary btn-block" type="submit">Izmeni grad</button>  <br/>
@endisset
 </form>
 </div>  
        </div>
 </div>
@endsection
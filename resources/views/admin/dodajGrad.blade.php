@extends('layout.layout')

@section('title')
Admin- gradovi dodavanje
@endsection


@include('components.links')
@section('content')
 <div class="container">
<div class="wrapper">
    
 @include('components.alerts')
 
<div id="dodajMeni">
   
 <form class="form-control" id="dodajMeni" method="post" action="{{route('proveraGrada')}}" >
 {{ csrf_field() }}

<h4 class="form-signin-heading">Dodaj grad</h4><br/>

<input type="text" class="form-control" name="grad" id="grad" placeholder="Naziv grada" required="true" value="{{old('grad')}}" /><br/>
<button class="btn btn-lg btn-primary btn-block" type="submit">Dodaj grad</button>  <br/>
 </form>
 </div>  
        </div>
 </div>
@endsection
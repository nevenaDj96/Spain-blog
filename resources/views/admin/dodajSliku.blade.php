@extends('layout.layout')

@section('title')
Admin- slika dodavanje
@endsection


@include('components.links')
@section('content')
 <div class="container">
<div class="wrapper">
    
 @include('components.alerts')
 
<div id="dodajMeni">
   
 <form class="form-control" id="dodajMeni" method="post" action="{{route('proveraSlike')}}" enctype="multipart/form-data" >
 {{ csrf_field() }}

<h4 class="form-signin-heading">Dodaj sliku</h4><br/>

<input type="text" class="form-control" name="alt" id="alt" placeholder="alt" required="true" value="{{old('alt')}}" /><br/>
<input type="file" class="form-control" name="slika" id="slika" required="true"/>
<button class="btn btn-lg btn-primary btn-block" type="submit">Dodaj sliku</button>  <br/>
 </form>
 </div>  
        </div>
 </div>
@endsection
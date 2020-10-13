@extends('layout.layout')

@section('title')
Admin- slika izmena
@endsection


@include('components.links')
@section('content')
 <div class="container">
<div class="wrapper">
    
 @include('components.alerts')
 
<div id="dodajMeni">
  @isset($izmena) 
 <form class="form-control" id="dodajMeni" method="post" action="{{route('proveraIzmeneSlike')}}" enctype="multipart/form-data" >
 {{ csrf_field() }}

<h4 class="form-signin-heading">Izmena slike</h4><br/>

<input type="text" class="form-control" name="alt" id="alt" placeholder="alt" required="true" value="{{$izmena->alt}}" /><br/>
<input type="file" class="form-control" name="slika" id="slika" required="true" />
<br/>
<img src="{{asset($izmena->putanja)}}"  style="width:252px; height:100px;"/>
<input type="hidden" name="idGalerija" value="{{$izmena->idGalerija}}"/>
<br/>
<br/>
<button class="btn btn-lg btn-primary btn-block" type="submit">Izmeni sliku</button><br/>


 </form>
  @endisset
 </div>  
 </div>
 </div>
@endsection


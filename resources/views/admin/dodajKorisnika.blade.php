@extends('layout.layout')

@section('title')
Admin- korisnik dodavanje
@endsection


@include('components.links')
@section('content')
 <div class="container">
<div class="wrapper">
    
 @include('components.alerts')
 
<div id="dodajMeni">
   
 <form class="form-control" id="dodajMeni" method="post" action="{{route('proveraDodavanjaKorisnika')}}" >
 {{ csrf_field() }}

<h4 class="form-signin-heading">Dodaj korisnika</h4><br/>

<input type="text" class="form-control" name="ime" id="ime" placeholder="Ime" required="true" value="{{old('ime')}}" /><br/>
<input type="text" class="form-control" name="prezime" id="prezime" placeholder="Prezime" required="true" value="{{old('prezime')}}" /><br/>
<input type="text" class="form-control" name="email" id="email" placeholder="Email" required="true" value="{{old('email')}}" /><br/>
<input type="text" class="form-control" name="lozinka" id="lozinka" placeholder="Lozinka" required="true" value="{{old('lozinka')}}"/><br/>
<button class="btn btn-lg btn-primary btn-block" type="submit">Dodaj korisnika</button>  <br/>
 </form>
</div>  
        </div>
 </div>
@endsection


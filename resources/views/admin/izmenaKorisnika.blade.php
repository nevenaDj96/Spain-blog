@extends('layout.layout')

@section('title')
Admin- korisnik izmena
@endsection


@include('components.links')
@section('content')
 <div class="container">
<div class="wrapper">
    
 @include('components.alerts')
 
<div id="dodajMeni">
   
 <form class="form-control" id="dodajMeni" method="post" action="{{route('proveraIzmene')}}" >
 {{ csrf_field() }}

<h4 class="form-signin-heading">Izmeni korisnika</h4><br/>
@isset($izmena)
<input type="text" class="form-control" name="ime" id="ime" placeholder="Ime" required="true" value="{{$izmena->ime}}" /><br/>
<input type="text" class="form-control" name="prezime" id="prezime" placeholder="Prezime" required="true" value="{{$izmena->prezime}}" /><br/>
<input type="text" class="form-control" name="email" id="email" placeholder="Email" required="true" value="{{$izmena->email}}" /><br/>
<input type="text" class="form-control" name="lozinka" id="lozinka" placeholder="Lozinka" required="true" value="{{$izmena->lozinka}}"/><br/>
<input type="hidden" name="idKorisnik" value="{{$izmena->idKorisnik}}"/>




                    
  <select name="uloga" class="form-control" required="true" autofocus="">
                         <option value="0">Izaberite ulogu</option>
                         
                    @isset($uloga)
                    @foreach($uloga as $u)
                    
                   <option value='{{ $u->idUloga }}' {{ ($u->idUloga == $izmena->idUloga)? 'selected' : '' }} >{{$u->naziv}}</option>
                    
                    @endforeach
                    
               @endisset

                   
                    </select><br/>

<button class="btn btn-lg btn-primary btn-block" type="submit">Izmeni korisnika</button>  <br/>
@endisset
 </form>
</div>  
        </div>
 </div>
@endsection


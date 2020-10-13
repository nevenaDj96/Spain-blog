@extends('layout.layout')

@section('title')
Admin - korisnici
@endsection


@section('content')

 @include('components.links')
 <div class="container">
 
    <div class="row">
        <div id='dodajMeni'> 
  <!-- Title -->
    <h2 class="mt-4 text-center">Korisnici</h2>
                 @include('components.alerts')
 
                             <table class="table table-striped">

    <!--Table head-->
    <thead>
        <tr>
            <th>id</th>
            <th>ime</th>
            <th>prezime</th>
             <th>email</th>
              <th>lozinka</th>
              <th>uloga</th>
            <th><a class="btn btn-primary" href="{{route('dodajKorisnika')}}">Dodaj korisnika</a></th>
        </tr>
    </thead>
      <!--Table head-->

    <!--Table body-->
    <tbody>
        @isset($korisnici)
        @foreach($korisnici as $k)
        <tr>
            <th>{{$k->idKorisnik}}</th>
            <td>{{$k->ime}}</td>
            <td>{{$k->prezime}}</td>
            <td>{{$k->email}}</td>
             <td>{{$k->lozinka}}</td>
              <td>{{$k->naziv}}</td>
            <td><a href="{{route('izmenaKorisnika',['id' => $k -> idKorisnik ])}}">izmeni</a></td>
           <td><a href="{{route('brisanjeKorisnika',['id' => $k -> idKorisnik ])}}">obriši</a></td>
        </tr>
      @endforeach
      @endisset
    </tbody>

    <!--Table body-->

</table>
<!--Table-->
       
   
        </div>
    </div>
</div>
 
 
 @endsection
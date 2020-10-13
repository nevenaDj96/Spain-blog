@extends('layout.layout')

@section('title')
Admin - destinacije
@endsection


@section('content')

 @include('components.links')
 <div class="container">
 
    <div class="row">
  <!-- Title -->
             <h2 class="mt-4 text-center">Postovi</h2>
                 @include('components.alerts')
 
                 
                 <table class="table table-striped">

    <!--Table head-->
    <thead>
        <tr>
            <th>id</th>
            <th>naslov</th>
            <th>opis</th>
             <th>sadrzaj</th>
             <th>slika</th>
             <th>alt</th>
             <th>grad</th>
              <th>datum izmene</th>
            <th><a class="btn btn-primary" href="{{route('dodajPost')}}">Dodaj post</a></th>
        </tr>
    </thead>
    <!--Table head-->

    <!--Table body-->
    <tbody>
        @isset($postovi)
        @foreach($postovi as $p)
        <tr>
            <th>{{$p->idPost}}</th>
            <td>{{$p->naslov}}</td>
            <td>{{$p->opis}}</td>
            <td>{{$p->sadrzaj}}</td>
            <td><img src='{{ asset ($p->putanja) }}' style='width: 100px; height: 50px;'/></td>
             <td>{{$p->alt }}</td>
             <td>{{$p->grad }}</td>
             @if($p->datum_izmene)
              <td>{{ date('d.m.Y.', strtotime($p->datum_izmene)) }}</td>
              @else
                 <td></td>
              @endif
            <td><a href="{{route('izmeniPost',['id' => $p -> idPost])}}">izmeni</a></td>
            
             <td><a href="{{route('brisanjePostova',['id' => $p -> idPost])}}">obriši</a></td>
        </tr>
      @endforeach
      @endisset
    </tbody>

    <!--Table body-->

</table>
<!--Table-->
       
   
<!-- PAGINACIJA -->
    <ul class="pagination" id="paginacija">
    <!-- Previous Page Link -->
    @if ($postovi->onFirstPage())
        <li class="disabled"><span>&laquo;</span></li>
    @else
        <li><a href="{{ $postovi->previousPageUrl() }}" rel="prev">&laquo;</a></li>
    @endif

    <!-- Next Page Link -->
    @if ($postovi->hasMorePages())
        <li><a href="{{ $postovi->nextPageUrl() }}" rel="next">&raquo;</a></li>
    @else
        <li class="disabled"><span>&raquo;</span></li>
    @endif
</ul>
        
    </div>
</div>
 
 
 @endsection
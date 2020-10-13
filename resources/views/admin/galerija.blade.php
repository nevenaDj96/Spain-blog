@extends('layout.layout')

@section('title')
Admin - galerija

@endsection


@section('content')



 @include('components.links')
 
<div class="container">
    <div class="row">
        
        
        <h2> Galerija </h2>
         @include('components.alerts')
    <!--Table-->
<table class="table table-striped">

    <!--Table head-->
    <thead>
        <tr>
            <th>id</th>
            <th>alt</th>
            <th>slika</th>
            <th><a class="btn btn-primary" href="{{route('dodajSliku')}}">Dodaj sliku</a></th>
        </tr>
    </thead>
    <!--Table head-->

    <!--Table body-->
    <tbody>
        @isset($gal)
        @foreach($gal as $g)
        <tr>
            <th>{{$g->idGalerija}}</th>
            <td>{{$g->alt}}</td>
            <td><img src="{{asset($g->putanja)}}" style="width:320px;height:200px;"/></td>
            <td><a href="{{route('izmenaSlike',['id' => $g -> idGalerija])}}">izmeni</a></td>
             <td><a href="{{route('obrisiSliku',['id' => $g -> idGalerija ])}}">obriši</a></td>
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
    @if ($gal->onFirstPage())
        <li class="disabled"><span>&laquo;</span></li>
    @else
        <li><a href="{{ $gal->previousPageUrl() }}" rel="prev">&laquo;</a></li>
    @endif

    <!-- Next Page Link -->
    @if ($gal->hasMorePages())
        <li><a href="{{ $gal->nextPageUrl() }}" rel="next">&raquo;</a></li>
    @else
        <li class="disabled"><span>&raquo;</span></li>
    @endif
</ul>     
        
        
    </div>
</div>



@endsection

@extends('layout.layout')
@section('title')
Galerija
@endsection

@section('css')
@parent
<link href="{{ asset('/') }}/css/lightbox.min.css" rel="stylesheet"/>
@endsection

@section('content')

<div class='col-md-12' id='galerija'>
     <div class="container">
@isset($gal)
@foreach($gal as $g)

<a class="example-image-link" href="{{ asset($g->putanja) }}" data-lightbox="example-set" data-title="Or press the right arrow on your keyboard.">
<img class="example-image" src="{{ asset($g->putanja) }}" alt="{{ $g->alt }}"/></a>



@endforeach
@endisset

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

@section('js')
@parent
  <script src="{{ asset('js/lightbox-plus-jquery.min.js') }}"></script>
@endsection
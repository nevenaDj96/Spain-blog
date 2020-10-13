@extends('layout.layout')
@section('title')
Autor
@endsection

@section('content')
<div class="container">
     
<div class="py-7" id="autor">

    <img src="{{asset('/img/ja.jpg')}}" alt="autor" width="300px" height="300px"/><br/>
    
    <div class="py-5">
        <b>Zovem se Nevena Djakovic. </br> </br> Živim u Obrenovcu.
            Student sam visoke ICT škole.
            Sajt je radjen kao predispitna obaveza za potrebe škole. </b> 
    </div>
    
</div>
</div>


@endsection


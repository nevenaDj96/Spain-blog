@extends('layout.layout')

@section('title')
Kontakt
@endsection

@section('content')

<div id="kontakt">
<div class="container">

      <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">

             @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
       
            @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
                
            @endif
            
            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
                
            @endif
            
            
            
          <!-- Title -->
          <h1 class="mt-4">Pošaljite nam poruku</h1>

          <hr>

     <div class="form-area" id="kontaktForma">  
        <form role="form" onSubmit="return proveraPoruke()"  method="post" action="{{route('proveraKontakt')}}">
            {{csrf_field()}}
            <br style="clear:both">
            <div class="form-group">
                    <input type="text" class="form-control" id="mail" name="mail" placeholder="Email" required="true">
                    <span class="error" id="errEmail">Email nije validan</span><br/>
            </div>
            <div class="form-group">
                    <input type="text" class="form-control" id="naslov" name="naslov" placeholder="Naslov" required="true">
                    <span class="error" id="errNaslov">Naslov nije validan</span><br/>
            </div>
            <div class="form-group">
                <textarea class="form-control" type="textarea" id="poruka" name="poruka" placeholder="Poruka" maxlength="200" rows="7" required="true"></textarea>
                <span class="error" id="porukaErr">Poruka nije u dobrom formatu</span><br/>
            </div>

            <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right">Pošalji</button>
        </form><br/>
  
    </div>
          


        </div>


    </div>
</div>

@endsection


@section('js')
@parent

<script type="text/javascript" src="{{ asset('js/provera.js') }}"></script>


@endsection
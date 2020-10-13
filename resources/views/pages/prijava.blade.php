@extends('layout.layout')

@section('title')
Prijava
@endsection

@section('content')


<section class="py-5">
      <div class="container">
        <div class="wrapper">
            
            
           
            
            <form class="form-signin" method="post" action="{{route('proveraPrijava')}}" onsubmit="return proveraPrijava()">     
                {{ csrf_field() }}
                

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
            
                <h2 class="form-signin-heading">Prijavite se </h2><br/>
                <span class="error" id="emailErr">Email nije validan</span><br/>
                <input type="text" class="form-control" name="email" id="email" placeholder="Email" required="true" autofocus="" /><br/>
                <span class="error" id="lozinkaErr">Lozinka nije validna</span><br/>
                <input type="password" class="form-control" name="lozinka" id="lozinka" placeholder="Lozinka" required="true"/> <br/>
                <br/>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Prijavite se</button>  <br/>
                <label>Ukoliko niste registrovani, <a href="{{route('registracija')}}">registrujte se</a>.</label>
            </form>
        </div>
      </div>
    </section>

@endsection


@section('js')
@parent
 <script src="{{asset('/')}}/js/provera.js"></script>
@endsection
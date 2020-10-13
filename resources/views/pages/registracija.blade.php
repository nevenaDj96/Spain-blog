@extends('layout.layout')


@section('title')

Registracija

@endsection


@section('content')
       
            <form class="form-signin" method="post" action="{{route('proveraReg')}}" onsubmit="return proveraReg()">
                
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
                
                
                
                <h2 class="form-signin-heading">Registrujte se </h2><br/>
                <span class="error" id="imeErr">Ime moze sadrzati samo slova i brojeve (3, 15)</span><br/>
                <input type="text" class="form-control" name="ime" id="ime" placeholder="Ime" required="true" autofocus="" /><br/>
                <span class="error" id="prezimeErr">Prezime moze sadrzati samo slova i brojeve (3, 15)</span><br/>
                <input type="text" class="form-control" name="prezime" id="prezime" placeholder="Prezime" required="true" autofocus="" /><br/>
                
                
                <span class="error" id="emailErr">Email adresa nije validna</span><br/>
                <input type="text" class="form-control" name="email" id="email" placeholder="Email adresa" required="true" autofocus="" /><br/>
                
                <span class="error" id="lozinkaErr">Lozinka moze sadrzati samo slova i brojeve (6, 15)</span><br/>
                <input type="password" class="form-control" name="lozinka" id="lozinka" placeholder="Lozinka" required="true"/> <br/>

                <span class="error" id="lozinka2Err">Lozinke se ne poklapaju</span><br/>
                <input type="password" class="form-control" name="lozinka2" id="lozinka2" placeholder="Potvrdite lozinku" required="true"/><br/>
                
                
                <button class="btn btn-lg btn-primary btn-block" type="submit">Registrujte se</button>  <br/>
                <label>Ukoliko imate nalog, prijavite se <a href="{{ route('prijava') }}">ovde</a>.</label>
            </form>
@endsection


@section('js')
@parent
<script src="{{asset('/')}}js/provera.js"></script>
@endsection
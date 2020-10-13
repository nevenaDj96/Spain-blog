 <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top"  id='nav'>
      <div class="container">
        <a class="navbar-brand" href="{{route('pocetna')}}"><img src='{{ asset('/')}}/img/flag.png'/></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            @isset($meni)
            
          <ul class="navbar-nav ml-auto">
              @foreach($meni as $m)
            <li class="nav-item {{ (Request::is($m->putanja)) ?  'active' : '' }}">
              <a class="nav-link" href="{{ asset($m->putanja) }}">{{$m->naziv}}
              </a>
            </li>
            @endforeach
            </ul>
            @endisset
            
             @if(!session()->has('kor'))
              <li class="nav-item">
                <a class="nav-link {{ (Request::is('prijava'))?  'active' : '' }}" href="{{ route('prijava') }}">
                  Prijavite se
                </a>
              </li>
            @endif
           @if(session()->has('kor'))
           
            @if(session()->get('kor')[0]->naziv == 'admin')
              <li  class="nav-item">
                <a class="nav-link" href="{{ route('admin') }}">
                Admin
                </a>
              </li>
              @endif
              @endif
       
              
               
               @if(session()->has('kor'))
               <li  class="nav-item {{ (Request::is('korisnik'))?  'active' : '' }}" >
                <a class="nav-link" href="{{ route('korisnik') }}">
                
                    {{ session()->get('kor')[0]->ime." ".session()->get('kor')[0]->prezime }}
                    
                </a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="{{route('odjava')}}">
                  Odjavite se 
                </a>
              </li>
            @endif
         </div>
      </div>
    </nav>

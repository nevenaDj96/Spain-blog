
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('/')}}/img/image.ico" type="image/gif" sizes="16x16"> 
    
    <title>Španija |  @yield('title')</title>

     <link rel="shortcut icon" href="{{ asset('/')}}/img/image.ico" type="image/x-icon"/>
    
    @section('css')
    <!-- Bootstrap core CSS -->
    <link href="{{asset('/')}}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('/')}}/css/full-width-pics.css" rel="stylesheet">
    <link href="{{asset('/')}}/css/style.css" rel="stylesheet">
    @show
  </head>

  <body>

   @include('components.nav')

   <div class='sadrzaj'>
   @yield('content')
   </div>
   
   
   @include('components.footer')

  @section('js')
    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('/')}}vendor/jquery/jquery.min.js"></script>
    <script src="{{asset('/')}}vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
     const baseUrl = '{{ route("pocetna") }}';
    </script>
    @if(session()->has('korisnik'))
    <script>
        var idKorisnik = {{session('kor')[0]->idKorisnik}};
    </script>
    @endif 
    
    @if(!session()->has('kor'))
    <script>
        var idKorisnik = null;
    </script>
    @endif
    @show
  </body>

</html>

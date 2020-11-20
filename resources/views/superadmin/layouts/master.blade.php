@php $public_path=public_path(); @endphp
<!doctype html>

<html>

<head>

   @include('superadmin.layouts.inc.head')

</head>

<body>



    @include('superadmin.layouts.inc.header')

  
    @include('superadmin.layouts.inc.nav')

   
         @yield('content')

  

   <footer class="row">

       @include('superadmin.layouts.inc.footer')

   </footer>



</body>

</html>
@php $public_path=public_path(); @endphp
<!doctype html>

<html>

<head>

   @include('storeowner.layouts.inc.head')

</head>

<body>



    @include('storeowner.layouts.inc.header')

  
    @include('storeowner.layouts.inc.nav')

   
         @yield('content')

  

   <footer class="row">

       @include('storeowner.layouts.inc.footer')

   </footer>



</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    @include('layouts.app.meta')
    @include('layouts.app.css')
    @yield('css')

</head>

<body>

    
   @yield('content')

@include('layouts.app.footer')


  

    <!-- js -->
    @include('layouts.app.script')

</body>

</html>

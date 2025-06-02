<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    @include('layouts.app.meta')
    @include('layouts.app.css')
    @yield('css')

</head>

<body>
@include('layouts.app.sidebar')

@include('layouts.app.header')


<main class="nxl-container">
    <div class="nxl-content">
   @yield('content')
</div>
@include('layouts.app.footer')
          </main>

  

    <!-- js -->
    @include('layouts.app.script')

</body>

</html>

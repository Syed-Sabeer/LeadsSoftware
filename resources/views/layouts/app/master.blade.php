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
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>
@include('layouts.app.footer')
          </main>

  

    <!-- js -->
    @include('layouts.app.script')

</body>

</html>

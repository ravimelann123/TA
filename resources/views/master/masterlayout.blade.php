<!doctype html>
<html lang="en">

<head>
    @include('master.head')

<body style="background-color: #e9ecef">

    @include('master.navbar')
    @if(auth()->user()->role=='admin')
    <div class="container mt-3">
        @yield('content')
        <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-angle-double-up"></i></button>
    </div>
    @endif
    @if(auth()->user()->role=='user')

    <div class="container mt-3">
        @yield('content')
        <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-angle-double-up"></i></button>
    </div>
    @endif
    @if(auth()->user()->role=='superadmin')
    <div class="container mt-3">
        @yield('content')
        <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-angle-double-up"></i></button>
    </div>
    @endif

    {{-- JS --}}

    @include('master.s')
    @yield('footer')
</body>


</html>

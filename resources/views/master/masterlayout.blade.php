<!doctype html>
<html lang="en">

<head>
    @include('master.head')


<body>
    @include('master.navbar')

    @if(auth()->user()->role=='admin')
    <div class="container">
        @yield('content')
    </div>
    @endif
    @if(auth()->user()->role=='user')
    <div class="container">
        @yield('content')
    </div>
    @endif


    @include('master.s')
</body>

</html>

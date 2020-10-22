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



    {{-- JS --}}


    @include('master.s')
    @yield('footer')


</body>


</html>

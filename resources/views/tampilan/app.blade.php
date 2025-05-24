<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    @include('tampilan.head')
</head>

<body>

    @include('tampilan.navigasi')
    
    @yield('content')

    @include('tampilan.footer')
    @include('tampilan.script')
</body>

</html>

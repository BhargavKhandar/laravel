<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Permission</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <style>
        .footer-container {
            width: 100%;
            position: absolute;
            bottom: 0;
        }
    </style>

    @include('layouts.includes')

</head>

<body>
    @include('layouts.header')
    @include('layouts.sidebar')

    <main class="main" id="main">
        @yield('content')
    </main>

    {{-- <div class="footer-container"> --}}
    @include('layouts.footer')
    {{-- </div> --}}


</body>

</html>

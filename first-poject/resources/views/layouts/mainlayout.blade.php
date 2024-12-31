<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    {{-- set title using @yield --}}
    <!-- <title>Bhargav's :-&nbsp; @yield('title', 'website')</title> -->
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<div class="header">
  <h1>Welcome to Bhargav's Blog</h1>
</div>

<div class="nav">
  <a href="/">Home</a>
  <a href="/about">About</a>
  {{-- normal method to open new page --}}
  <a href="/post">Post</a>

  {{-- name method to open new page --}}
  {{-- <a href="{{ route('mypost') }}">Post</a> --}}

</div>

{{-- set the content using yield --}}
{{-- @yield('content', '<h2>No content found.</h2>') --}}

{{-- set the content using @hasSection --}}
@hasSection('content')
    @yield('content')
@else
    <h2>No Content Found.</h2>
@endif


<div class="aside">
    <aside>
        <a href="/">Home</a>
        <a href="/about">About</a>
        <a href="/post">Post</a>
    </aside>
</div>

<div class="footer">
  <p>Footer Content &copy; 2024 Bhargav</p>
</div>

</body>
</html>

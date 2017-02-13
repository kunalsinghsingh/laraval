<html>
<head>
<title>@yield('title')</title>
@include('partials.htmlheader')
@yield('styles')
</head>
<body>
@include('partials.header')
<div class="container">
@yield('content')
</div>
</body>
 @include('partials.scripts')
@yield('scripts')
</html>
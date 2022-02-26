<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('components.layouts.head')
</head>

<body>
    <header class="custom-header">
        @include('components.layouts.header')
    </header>
    @yield('content')



    @include('components.layouts.footer')
</body>

</html>
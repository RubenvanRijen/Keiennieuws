<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('components.layouts.head')
</head>

<body>
    <header class="custom-header">
        @include('components.layouts.header')
    </header>
    <div class="container-fluid">
        <div class="row ">
            @include('components.layouts.verticalSideBar')
            <div class="col-sm min-vh-100">
                @yield('content')

                @yield('scripts')
            </div>
        </div>
    </div>

</body>

</html>
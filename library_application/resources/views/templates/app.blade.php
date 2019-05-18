<html>

<head>
    @include('partials.head')
</head>

<body>
    <div class="app-page">
    @include('partials.header')
    @yield('app_container')
    </div>

    @include('partials.scripts')
</body>

</html>
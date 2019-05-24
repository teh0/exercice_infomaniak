<html>

<head>
    @include('partials.head')
</head>

<body>
        @include('partials.screen_responsive')
    <div class="app-page">
    @include('partials.header')
    @yield('app_container')
    </div>

    @include('partials.scripts')
</body>

</html>
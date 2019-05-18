<html>
@include('partials.head')
<body>
    <div class="app-container">
        @include('partials.header')
        @yield('app_page')
    </div>
    @include('partials.header')
</body>
</html>
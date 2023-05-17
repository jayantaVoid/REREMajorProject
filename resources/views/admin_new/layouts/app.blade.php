<!DOCTYPE html>
<html lang="en">
@include('admin_new.layouts.partials.header')

<body>
    <div class="main-wrapper">
        @include('admin_new.layouts.partials.navbar')
        @include('admin_new.layouts.partials.sidebar')

        <div class="page-wrapper">
            @yield('content')
            @include('admin_new.layouts.partials.footer')
        </div>

    </div>
    @include('admin_new.layouts.partials._footer')
    <!-- Scripts -->
    @stack('script')
</body>

</html>

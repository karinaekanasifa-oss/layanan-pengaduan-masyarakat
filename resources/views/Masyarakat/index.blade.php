<!DOCTYPE html>
<html lang="en">
    @include('Masyarakat.partials.head')
    <body id="page-top">

        <!-- Navigation -->
        @include('Masyarakat.components.navbar')

        <!-- Main Content / Yield Section -->
        @yield('content')

        <!-- Footer -->
        @include('Masyarakat.components.footer')

        <!-- Scripts -->
        @include('Masyarakat.partials.script')
    </body>
</html>

<!DOCTYPE html>
<html lang="en">

{{-- Head Section --}}
@include('Petugas.partials.head')
{{-- Head Section --}}

<body>

  <!-- ==========================================
         START: Sidebar Component
         Highly polished, dark-green sticky navigation
         ========================================== -->
 @include('Petugas.components.sidebar')
  <!-- ==========================================
         END: Sidebar Component
         ========================================== -->

  <!-- ==========================================
         START: Main Content Area
         ========================================== -->
  <div class="main-wrapper">

    <!-- START: Top Navbar Component -->
    @include('Petugas.components.navbar')
    <!-- END: Top Navbar Component -->

    <!-- Content Area -->
            <main class="content-wrapper p-4">
                @yield('content')
            </main>

    <!-- START: Footer Component -->
   @include('Petugas.components.footer')
    <!-- END: Footer Component -->

  </div>
  <!-- ==========================================
         END: Main Content Area
         ========================================== -->

    {{-- Script Section --}}
    @include('Petugas.partials.script')
    {{-- Script Section --}}
</body>

</html>

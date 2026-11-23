<!DOCTYPE html>
<html lang="en">

{{-- Head Section --}}
@include('Admin.partials.head')
{{-- Head Section --}}

<body>

  <!-- ==========================================
         START: Sidebar Component
         Highly polished, dark-green sticky navigation
         ========================================== -->
 @include('Admin.components.sidebar')
  <!-- ==========================================
         END: Sidebar Component
         ========================================== -->

  <!-- ==========================================
         START: Main Content Area
         ========================================== -->
  <div class="main-wrapper">

    <!-- START: Top Navbar Component -->
    @include('Admin.components.navbar')
    <!-- END: Top Navbar Component -->

    <!-- Content Area -->
            <main class="content-wrapper p-4">
                @yield('content')
            </main>

    <!-- START: Footer Component -->
   @include('Admin.components.footer')
    <!-- END: Footer Component -->

  </div>
  <!-- ==========================================
         END: Main Content Area
         ========================================== -->

    {{-- Script Section --}}
    @include('Admin.partials.script')
    {{-- Script Section --}}
</body>

</html>

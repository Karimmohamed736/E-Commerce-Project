
@include('Admin.layouts.header')
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
@include('Admin.layouts.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('Admin.layouts.navbar')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
        {{-- @include('Admin.layouts.body') --}}
        @yield('content')
          </div>

          <!-- partial:partials/_footer.html -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- End custom js for this page -->
    @include('Admin.layouts.footer')
</body>

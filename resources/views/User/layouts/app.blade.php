
  </head>

  <body>

    @include('User.layouts.header')

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    @include('User.layouts.Banner')
    <!-- Banner Ends Here -->

@yield('content')


@include('User.layouts.card')


@include('User.layouts.footer')


  </body>

</html>

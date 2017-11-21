@include('templates.header')

<body class="fixed-nav sticky-footer bg-light" id="page-top">

  @include('templates.navbar')

  @yield('content')

  @include('templates.footer')

  @include('templates.scripts')


</body>

</html>

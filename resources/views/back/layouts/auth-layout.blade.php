
<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>@yield('pageTitle')</title>
    <!-- CSS files -->
    <base href="/">
    <link href="./back/dist/css/tabler.min.css?1674944402" rel="stylesheet"/>
    <link href="./back/dist/css/tabler-flags.min.css?1674944402" rel="stylesheet"/>
    <link href="./back/dist/css/tabler-payments.min.css?1674944402" rel="stylesheet"/>
    <link href="./back/dist/css/tabler-vendors.min.css?1674944402" rel="stylesheet"/>
    @stack('stylesheets')

    <link href="./back/dist/css/demo.min.css?1674944402" rel="stylesheet"/>
  </head>
  <body  class="border-top-wide border-primary d-flex flex-column">
    @yield('content')

    <script src="./back/dist/js/tabler.min.js?1674944402" defer></script>
    @stack('scripts')

    <script src="./back/dist/js/demo.min.js?1674944402" defer></script>
  </body>
</html>

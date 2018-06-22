<html>
   <head>
        <title>@yield('Food and Beverage Point of Sales Systems')</title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>        
        <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/select2.min.js') }}"></script>
        @yield('extra-css')          

        <script src="{{ asset('js/app/config.js') }}"></script>
   </head>
   <body>
        <div class="container">
           @yield('content')
        </div>        
   </body>
</html>
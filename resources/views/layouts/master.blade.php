<html>
   <head>
        <title>@yield('Food and Beverage Point of Sales Systems')</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

        <script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>        
        <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
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
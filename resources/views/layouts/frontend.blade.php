<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta Content-Security-Policy: frame-src https://google.com/>
        <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Thunderlab.ID</title>

        <!-- Custom css -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i|Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}"></link>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    </head>
    <body>
        @yield('template_content')

        <!-- All js library -->
        <script src="{{ asset('js/frontend/jquery.min.js') }}"></script>
        <script src="{{ asset('js/frontend/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/frontend/jquery.flexslider-min.js') }}"></script>
        <script src="{{ asset('js/frontend/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('js/frontend/isotope.min.js') }}"></script>
        <script src="{{ asset('js/frontend/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('js/frontend/jquery.scrollTo.min.js') }}"></script>
        <script src="{{ asset('js/frontend/smooth.scroll.min.js') }}"></script>
        <script src="{{ asset('js/frontend/jquery.appear.js') }}"></script>
        <script src="{{ asset('js/frontend/jquery.countTo.js') }}"></script>
        <script src="{{ asset('js/frontend/jquery.scrolly.js') }}"></script>
        <script src="{{ asset('js/frontend/plugins-scroll.js') }}"></script>
        <script src="{{ asset('js/frontend/imagesloaded.min.js') }}"></script>
        <script src="{{ asset('js/frontend/pace.min.js') }}"></script>
        <script src="{{ asset('js/frontend/main.js') }}"></script>
        <script src="{{ asset('js/frontend/formValidation.js') }}"></script>

        @yield('template_script')
    </body>
</html>

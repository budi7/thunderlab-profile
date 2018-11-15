<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Thunder CMS</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        
        <!-- Custom css -->
        <link rel="stylesheet" href="{{ URL::asset('css/backend.css') }}"></link>
    </head>
    <body>
        @yield('template_content')
        <!-- JS -->
        {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
        <!-- All js library -->
        <script src={{ asset('js/backend/core/jquery.min.js') }}></script>
        <script src={{ asset('js/backend/core/bootstrap.min.js') }}></script>
        <script src={{ asset('js/backend/core/popper.min.js') }}></script>
        <script src={{ asset('js/backend/plugins/perfect-scrollbar.jquery.min.js') }}></script>

        <!-- Chart JS -->
        <script src={{ asset('js/backend/plugins/chartjs.min.js') }}></script>

        {{-- ajax image upload --}}
        <script src={{ asset('js/backend/plugins/imageSend.js') }}></script>

        <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
        <script src={{ asset('js/backend/black-dashboard.min.js') }}></script>
        
        @yield('template_script')

        <script>
            /*
        $().ready(function() {
            $sidebar = $('.sidebar');
            $navbar = $('.navbar');

            $full_page = $('.full-page');

            $sidebar_responsive = $('body > .navbar-collapse');
            sidebar_mini_active = true;
            white_color = false;

            window_width = $(window).width();

            fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();
        });
        */
        </script>

    </body>
</html>
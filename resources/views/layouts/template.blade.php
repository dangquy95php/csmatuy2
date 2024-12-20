<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('admin_library/assets/img/favicon.png')}}" rel="icon">
    <link href="{{ asset('admin_library/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('admin_library/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('admin_library/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('admin_library/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{ asset('admin_library/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{ asset('admin_library/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{ asset('admin_library/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{ asset('admin_library/assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
    <link href="{{ asset('admin_library/assets/css/toastr.min.css') }}" rel="stylesheet" type="text/css" >

    <!-- Template Main CSS File -->
    <link href="{{ asset('admin_library/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
    @stack('styles')
</head>

<body class="{{request()->is('admin/gate/input') ? 'is-set-header' : ''}}">

    @include('layouts.header')

    @include('layouts.sidebar')

    <main id="main" class="main">

        <div class="pagetitle">

        @yield('breadcrumb')

        </div>

        @yield('content')

    </main>

    @include('layouts.footer')

      <!-- Vendor JS Files -->
    <script src="{{asset('admin_library/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('admin_library/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin_library/assets/vendor/chart.js/chart.umd.js')}}"></script>
    <script src="{{asset('admin_library/assets/vendor/echarts/echarts.min.js')}}"></script>
    <script src="{{asset('admin_library/assets/vendor/quill/quill.min.js')}}"></script>
    <script src="{{asset('admin_library/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
    <script src="{{asset('admin_library/assets/vendor/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('admin_library/assets/vendor/php-email-form/validate.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{asset('admin_library/assets/js/main.js')}}"></script>
    <script src="{{asset('admin_library/assets/js/custom-sort.js')}}"></script>
    <!-- Jquery Slim JS -->
    <script src="{{ asset('admin_library/assets/js/jquery.min.js')}} "></script>

    <script src="{{ asset('admin_library/assets/js/jquery-ui.min.js')}} "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>                       
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

    <svg id="SvgjsSvg1145" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;"><defs id="SvgjsDefs1146"></defs><polyline id="SvgjsPolyline1147" points="0,0"></polyline><path id="SvgjsPath1148" d="M-1 270.2L-1 270.2C-1 270.2 176.9170673076923 270.2 176.9170673076923 270.2C176.9170673076923 270.2 294.86177884615387 270.2 294.86177884615387 270.2C294.86177884615387 270.2 412.80649038461536 270.2 412.80649038461536 270.2C412.80649038461536 270.2 530.7512019230769 270.2 530.7512019230769 270.2C530.7512019230769 270.2 648.6959134615385 270.2 648.6959134615385 270.2C648.6959134615385 270.2 766.640625 270.2 766.640625 270.2C766.640625 270.2 766.640625 270.2 766.640625 270.2 "></path></svg>

    @stack('scripts')

    <script src="{{ asset('admin_library/assets/js/toastr.min.js')}} "></script>
    <script src="{{ asset('js/select2.min.js')}}"></script>

    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/moment-with-locales.js') }}"></script>
    <script src="{{ asset('js/moment-timezone.js') }}"></script>

    <script>
        $(document).ready(function() {
            if (localStorage.getItem('toggle-sidebar')) {
                $('body').addClass('toggle-sidebar');
            }
        });
        $(".toggle-sidebar-btn").click(function() {
            if ($('body.toggle-sidebar').length == 0) {
                localStorage.removeItem('toggle-sidebar');
            } else {
                localStorage.setItem('toggle-sidebar', true);
            }
        });
    </script>
    
    {!! Toastr::message() !!}
</body>

</html>
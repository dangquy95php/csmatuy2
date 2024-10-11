<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang không tìm thấy</title>
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
</head>

<body>

  <main>
    <div class="container">

      <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <h1>404</h1>
        <h2>Trang bạn đang tìm kiếm không tồn tại.</h2>
        <a class="btn" href="{{route('dashboard')}}">Quay về trang chủ</a>
        <img src="{{ asset('admin_library/assets/img/not-found.svg') }}" class="img-fluid py-5" alt="Page Not Found">
        <div class="credits">
        Thiết kế bởi <a href="#">Cơ sở cai nghiện ma túy số 2</a>
        </div>
      </section>

    </div>
  </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
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
</body>

</html>
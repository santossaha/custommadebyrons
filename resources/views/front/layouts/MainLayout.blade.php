<!DOCTYPE html>
<html class="no-js">
<html lang="en">
<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>:: Simonrusticdesigns.com ::</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{url('/')}}/front/css/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('/')}}/front/css/plugins/animate.css">
    <link rel="stylesheet" href="{{url('/')}}/front/css/plugins/owl.carousel.min.css">
    <link rel="stylesheet" href="{{url('/')}}/front/css/plugins/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{url('/')}}/front/css/plugins/simplelightbox.min.css">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link rel="stylesheet" href="{{url('/')}}/front/fonts/fontawesome/fontawesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Muli:400,500,600|Overpass:400,600,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{url('/')}}/front/css/toastr.min.css">
        <!-- verola -->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{url('/')}}/front/css/style.css">
    <link rel="stylesheet" href="{{url('/')}}/front/css/responsive.css">
    <script src="{{url('/')}}/front/js/modernizr-2.8.3.min.js"></script>
    <script src="{{url('/')}}/front/js/jquery-3.2.1.min.js"></script>
    <script src="{{url('/')}}/front/js/popper.min.js"></script>
    <script src="{{url('/')}}/front/js/bootstrap.min.js"></script>
    <script src="{{url('/')}}/front/js/owl.carousel.min.js"></script>
    <script src="{{url('/')}}/front/js/isotope.pkgd.min.js"></script>
    <script src="{{url('/')}}/front/js/imagesLoaded.js"></script>
    <script src="{{url('/')}}/front/js/main.js"></script>
    <script src="{{url('/')}}/front/js/validate/jquery.validate.min.js"></script>
    <script src="{{url('/')}}/front/js/toastr.min.js"></script>

</head>
<body>
    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
    @include('front.common.header')
    @yield('content')
    @include('front.common.footer')
    @stack('scripts')
    <style>
        .p-hide{width:140px; display:flex; flex-direction: column;right: 0;
            left: inherit;}
        .p-hide a{padding-bottom: 15px;}
        .user-profile .form-group input{font-size: 14px;}
        .user-profile .form-group input::placeholder{font-size: 14px !important;}
    </style>


</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="Anil z" name="author">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="project ">
<meta name="keywords" content="">

<!-- SITE TITLE -->
<title>Home | project</title>
<!-- Favicon Icon -->
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/kclogo.jpg') }}">
<!-- Animation CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}" />
<!-- Latest Bootstrap min CSS -->
<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" />
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet" />
<!-- Icon Font CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/ionicons.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}" />
<!-- FontAwesome CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}" />
<!--- owl carousel CSS-->
<link rel="stylesheet" href="{{ asset('assets/owlcarousel/css/owl.carousel.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/owlcarousel/css/owl.theme.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/owlcarousel/css/owl.theme.default.min.css') }}" />
<!-- Magnific Popup CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/timeline.min.css') }}" />

<!-- Style CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" />
<link rel="stylesheet" id="layoutstyle" href="{{ asset('assets/color/theme.css') }}" />


<script>
var sc_project=11981757;
var sc_invisible=1;
var sc_security="35d2687e";
var sc_https=1;
</script>


</head>

<body>

<!-- LOADER -->
<div id="preloader">
    <span class="spinner"></span>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<!-- END LOADER -->

@include('frontend.layouts.partials.header')

    @yield('content')

@include('frontend.layouts.partials.footer')

<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a>

<!-- Latest jQuery -->
<script src="{{ asset('assets/js/jquery-1.12.4.min.js') }}"></script>
<!-- jquery-ui -->
<script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
<!-- popper min js -->
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<!-- Latest compiled and minified Bootstrap -->
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- owl-carousel min js  -->
<script src="{{ asset('assets/owlcarousel/js/owl.carousel.min.js') }}"></script>
<!-- magnific-popup min js  -->
<script src="{{ asset('assets/js/magnific-popup.min.js') }}"></script>
<!-- waypoints min js  -->
<script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
<!-- parallax js  -->
<script src="{{ asset('assets/js/parallax.js') }}"></script>
<!-- countdown js  -->
<script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
<!-- jquery.counterup.min js -->
<script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
<!-- imagesloaded js -->
<script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
<!-- isotope min js -->
<script src="{{ asset('assets/js/isotope.min.js') }}"></script>
<!-- jquery.parallax-scroll js -->
<script src="{{ asset('assets/js/jquery.parallax-scroll.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/timeline.js') }}"></script>

<!-- scripts js -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>

<script src="{{ asset('assets/js/slick.min.js') }}"></script>

<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->
<script>
    $('.timeline-1').Timeline({

      mode: 'horizontal',
       autoplay: true,
       dotsPosition: 'top',
    });
    $(document).ready(function () {
        var url = window.location;
        $('ul.navbar-nav a[href="'+ url +'"]').parent().addClass('active');
        $('ul.navbar-nav a').filter(function() {
             return this.href == url;
        }).parent().children().addClass('active');
    });
</script>

@stack('scripts')

</body>


</html>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        {{-- <link href="assets/libs/metrojs/release/MetroJs.Full/MetroJs.min.css" rel="stylesheet" type="text/css" /> --}}
        <link href="{{asset('css/MetroJs.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

        <!-- Bootstrap Css -->
        {{-- <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" /> --}}
        <link href="{{asset('css/bootstrap.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

        <!-- Icons Css -->
        {{-- <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" /> --}}
        <link href="{{asset('css/icons.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

        <!-- App Css-->
        {{-- <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" /> --}}
        <link href="{{asset('css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

        <!-- Sweet Alert-->
        <link href="{{asset('css/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- Select2-->
        <link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />

        <!-- style-->
        <link href="{{asset('css/style.css')}}" rel="stylesheet" />
        <link href="{{asset('css/frontend.css')}}" rel="stylesheet" />

        <link href="{{ asset('css/dropify.min.css') }}" rel="styleshet">

        <!-- Toastr-->
        <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">

        @yield('page-specific-styles')

    </head>

<body>


    @include('frontend.layouts.partials.header')

    @yield('content')

    @include('frontend.layouts.partials.footer')

    <a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a>

    <!-- JAVASCRIPT -->
    {{-- <script src="assets/libs/jquery/jquery.min.js"></script> --}}
    <script src="{{ asset('js/jquery.min.js') }} "></script>


    {{-- <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }} "></script>

    {{-- <script src="assets/libs/metismenu/metisMenu.min.js"></script> --}}
    <script src="{{ asset('js/metisMenu.min.js') }} "></script>

    {{-- <script src="assets/libs/simplebar/simplebar.min.js"></script> --}}
    <script src="{{ asset('js/simplebar.min.js') }} "></script>


    {{-- <script src="assets/libs/node-waves/waves.min.js"></script> --}}
    {{-- <script src="{{asset('js/waves.min.js')}} "></script> --}}

    {{-- <script src="assets/js/pages/dashboard.init.js"></script> --}}
    {{-- <script src="{{asset('js/dashboard.init.js')}}"></script> --}}

    <!-- Sweet alert init js-->
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>

    {{-- <script src="assets/js/app.js"></script> --}}
    <script src="{{ asset('js/app.js') }}"></script>

    {{-- Select2 --}}
    <script src="{{ asset('js/select2.min.js') }}"></script>

    <script src="{{ asset('js/scripts.js') }}"></script>

    <script src="{{ asset('js/toastr/toastr.js') }}"></script>

    <script src="{{ asset('js/jquery.repeater.min.js') }}"></script>

    <script src="{{ asset('js/form-repeater.init.js') }}"></script>

    {{-- <script>
            $(function () {
                $('.my-ckeditor').each(function (e) {
                    CKEDITOR.replace(this.id, {
                        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
                        filebrowserUploadMethod: 'form'
                    });
                });
            });
        </script> --}}

    <script>
        function deleteThis(obj) {
            let data = obj.getAttribute("link");
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = data;
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                } else {
                    Swal.fire(
                        'Cancelled!',
                        'Your file has been Cancelled.',
                        'error'
                    )
                }
            })
        }
    </script>

    @yield('page-specific-scripts')
    {!! Toastr::message() !!}

</body>


</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{asset('fe/img/favicon.ico')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="{{asset('https://fonts.gstatic.com')}}">
    <link href="{{asset('https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@700&display=swap')}}" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('fe/lib/flaticon/font/flaticon.css')}}" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('/fe/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('fe/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('fe/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<style>
    .btn-outline-light2 {
  color: #F3F3F3;
  border-color: #8bbf4d;
}
</style>

<body>
    <!-- Navbar Start -->
    @include('layoutcs.navbar')
    {{-- <button onclick="getLocation()">Try It</button>

<p id="demo"></p> --}}
    <!-- Navbar End -->



    @yield('content')

    <!-- Footer Start -->
    @include('layoutcs.footer')
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('fe/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('fe/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('fe/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Template Javascript -->
    <script src="{{asset('fe/js/main.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

    <script>
        @if(Session::has('m'))
        var type = "{{ Session::get('t', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('m') }}");
                break;

            case 'warning':
                toastr.warning("{{ Session::get('m') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('m') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('m') }}");
                break;
        }
      @endif

    //   $(document).ready(function(){
    //         get_location();
    //     });

    //     function get_location()
    //     {
    //         if(navigator.geolocation)
    //         {
    //             navigator.geolocation.getCurrentPosition(function(position){

    //                     var latitude = position.coords.latitude;
    //                     var longitude = position.coords.longitude;
    //                     $.post('/api/coordinate', {
    //             latitude: latitude,
    //             longitude: longitude
    //             });

    //             });
    //         }
    //     }


      </script>

    @stack('js')
</body>

</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CV. Mirai Alam Sejahtera') }}</title>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Ubuntu&subset=cyrillic,latin' rel='stylesheet' type='text/css' />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">



    <!-- Navbar -->


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">



    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="../../assets2/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="../../assets2/css/font-awesome.css">

    <link rel="stylesheet" href="../../assets2/css/templatemo-hexashop.css">

    <link rel="stylesheet" href="../../assets2/css/owl-carousel.css">

    <link rel="stylesheet" href="../../assets2/css/lightbox.css">
    <livewire:navbar />
    @include('sweetalert::alert')

</head>


<body>
    <br><br><br>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

<livewire:styles />
<livewire:scripts />
<!-- ***** Footer Start ***** -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="first-item">
                    <div class="logo">
                        <img src="../../assets/img/logo1.png" style="size:10px" alt="">
                    </div>
                    <ul>
                        <li><a href="#">Jl. Semeru No.227, Srebet, Purwosono, Sumbersuko, Kabupaten Lumajang, Jawa Timur 67316</a></li>
                        <li><a href="#">cvmiraialam.gmail.com</a></li>
                        <li><a href="#">010-020-0340</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <h4>Kategori &amp; Produk</h4>
                <ul>
                    <li><a href="#">Plywood</a></li>
                    <li><a href="#">LVL</a></li>
                    <li><a href="#">Veneer</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h4>Useful Links</h4>
                <ul>
                    <li><a href="#">Homepage</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h4>Help &amp; Information</h4>
                <ul>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">FAQ's</a></li>
                    <li><a href="#">Shipping</a></li>
                    <li><a href="#">Tracking ID</a></li>
                </ul>
            </div>
            <div class="col-lg-12">
                <div class="under-footer">
                    <p>Copyright © 2022 Shabrina Co., Ltd. All Rights Reserved.


                    <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>



</html>
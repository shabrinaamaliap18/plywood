<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') {{config ('app.name')}}</title>



    <meta charset="utf-8">


    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- DataTables -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="//datatables.net/download/build/nightly/jquery.dataTables.js"></script>

    <!-- sweet alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- CSS Libraries DataTables -->
    <link href="{{URL::to('../../assets1/css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
    <link href="{{URL::to('../../assets1/css/style.css')}}" rel="stylesheet">


    <!-- 
    Visual Admin Template
    https://templatemo.com/tm-455-visual-admin
    -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="../../../assets3/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../../assets3/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../assets3/css/templatemo-style.css" rel="stylesheet">
    <!-- JS -->
    <script type="text/javascript" src="../../assets3/js/jquery-1.11.2.min.js"></script> <!-- jQuery -->
    <script type="text/javascript" src="../../assets3/js/jquery-migrate-1.2.1.min.js"></script> <!--  jQuery Migrate Plugin -->
    <script type="text/javascript" src="../../assets3/https://www.google.com/jsapi"></script> <!-- Google Chart -->
    <script type="text/javascript" src="../../assets3/js/templatemo-script.js"></script> <!-- Templatemo Script -->

    <!-- Template CSS 
        -->
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <link rel="stylesheet" href="../../../assets/css/components.css">







    <script>
        $.noConflict();
        // Code that uses other library's $ can follow here.
    </script>



    @stack('page-styles')
</head>

<div id="app">
    <div class="main-wrapper">
        <!-- @include('admin.layouts.header') -->
        @include('admin.layouts.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <section class="section">


                @yield('content')


            </section>
<br><br><br><br><br><br><br><br><br><br><br><br>

            <footer class="text-right">
                <p>Copyright &copy; 2022 CV Mirai Alam Sejahtera
                    | Admin</p>
            </footer>
        </div>
        
    </div>

</div>


@stack('before-script')

<!-- General JS Scripts (nabrak sama ini) -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>




<!-- toast -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="../assets/js/stisla.js"></script>

<!-- for export all -->
<script src="{{URL::to('../../assets1/js/plugins/dataTables/datatables.min.js')}}"></script>
<script src="{{URL::to('../../assets1/js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Template JS File -->
<script src="../../../assets/js/scripts.js"></script>
<script src="../../../assets/js/custom.js"></script>



@stack('page-script')




</body>

</html>
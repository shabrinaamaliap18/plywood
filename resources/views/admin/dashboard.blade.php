@extends('admin.layouts.master')
@section('content')

        
<div class=" section-header">
    <h1>Dashboard</h1>
</div>
<div class="row">
    <div class="col-6">
        <a href="customer">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pelanggan</h4>
                    </div>
                    <div class="card-body">
                        <a style="color:#191d21 !important;" href="customer"><b>{{$totaluser}}</a></b>
                    </div>
                </div>
            </div>
    </div>
    <div class="col-6">
        <a href="pesanan">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-truck"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pesanan Dalam Proses</h4>
                    </div>
                    <div class="card-body">
                        <a style="color:#191d21 !important;" href="pesanan"><b>{{$totalproses}}</a></b>
                    </div>
                </div>
            </div>
    </div>
    <div class="col-6">
        <a href="customm">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pesanan Custom</h4>
                    </div>
                    <div class="card-body">
                        <a style="color:#191d21 !important;" href="customm"><b>{{$totalcustom}}</a></b>
                    </div>
                </div>
            </div>
    </div>

    <div class="col-6">
        <a href="pesanan/bayar">

            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pesanan Sukses</h4>
                    </div>
                    <div class="card-body">
                        <a style="color:#191d21 !important;" href="pesanan/bayar"><b>{{$totalsukses}}</a></b>
                    </div>
                </div>
            </div>

    </div>


</div>

<div class=" section-header">
    <h1>Perkembangan Jumlah Pesanan</h1>
</div>

<div id="container"></div>


<script type="text/javascript">
    var users = <?php echo json_encode($users) ?>;

    Highcharts.chart('container', {
        title: {
            text: ''
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
        },
        yAxis: {
            title: {
                text: 'Jumlah Pesanan'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Pesanan',
            data: users
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 200
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
</script>
@endsection
@push('page-scripts')
@endpush
@extends('admin.layouts.master')
@section('content')

        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
        </ol>
       
        <div class="row">
            <div class="col-xl-6 col-md-3">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Pesanan Custom</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="/customm">Lihat Detail</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-3">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Pesanan Dalam Proses</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="/pesanan">Lihat Detail</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-3">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Pesanan Sukses</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="/pesanan/bayar">Lihat Detail</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-3">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Pelanggan</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="/customer">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
       
<style>
    .card .card-body {
        font-size: large;
        font-weight: 300px;
    }
</style>

@endsection
@push('page-scripts')
@endpush
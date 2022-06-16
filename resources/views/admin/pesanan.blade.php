@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class=" section-header">
                <br>
                <h1>Manajemen Pesanan</h1><br>
            </div>
            <br>

            <head>
                <meta charset="utf-8">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
            </head>


            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

            <a href="/pesanan/bayar/" class="btn btn-success"> Pesanan Telah Dibayar</a> <br><br>
            <b>
                <h2>Pesanan Belum Dibayar</h2>
            </b>
            <br>
            <table id="myTable" class="table table-striped" style="width:100%">
                <thead class="table table-hover">
                    <tr>
                        <th width="80px" scope="col" style="text-align:center;">No. </th>
                        <th>Nama Customer</th>
                        <th>Produk</th>
                        <th>Jumlah Pembelian</th>
                        <th>Total Biaya</th>
                        <th>No Telp</th>
                        <th>Alamat</th>
                        <th>Lokasi</th>
                        <th>Alat Angkut</th>
                        <th>Ket</th>
                        <th>Status</th>
                        <th>Ongkir</th>
                        <th>Tanggal Pesan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($pesanan as $as)
                    <tr>
                        <th width="80px" scope="col" style="text-align:center;">{{$loop->iteration}}</th>
                        <td>{{ $as->name}}</td>
                        <td>{{ $as->nama}}</td>
                        <td>{{ $as->jumlah_pesanan}}</td>
                        <td>{{ $as->total_harga}}</td>
                        <td>{{ $as->nohp}}</td>
                        <td>{{ $as->alamat}}</td>
                        <td>{{ $as->lokasi}}</td>
                        <td>{{ $as->alat_angkut}}</td>
                        <td>{{ $as->ket}}</td>
                        <td>{{ $as->status}}</td>
                        <td>{{ $as->ongkir}}</td>
                        <td>{{ $as->tanggal_transaksi}}</td>
                        <td>
                            <a class="fas fa-edit" style="color:orange" href="pesanan/edit/{{$as->pesanan_id}}"></a>


                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
    </div>
</div>

<style>
    #myTable_info {
        float: right;
    }

    #myTable_paginate {
        padding: 10px;
        float: right;
    }


    .section .section-header h1 {
        color: white;
    }

    .section .section-header {
        background-color: cadetblue;
        border-radius: 8px;
    }
</style>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            pageLength: 25,
            responsive: true,
            paging: true,
            scrollX: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [{
                extend: 'copy'
            }, {
                extend: 'csv'
            }, {
                extend: 'excel',
                title: 'ExampleFile'
            }, {
                extend: 'pdf',
                title: 'ExampleFile'
            }, {
                extend: 'print',
                customize: function(win) {
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');
                    $(win.document.body).find('table').addClass('compact')
                        .css('font-size', 'inherit');
                }
            }]
        });
    });
</script>



@endsection
@push('page-scripts')
@endpush
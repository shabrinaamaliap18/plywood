@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class=" section-header">
                <br><h1>Manajemen Produk</h1><br>
            </div>
            <br>

            <head>
                <meta charset="utf-8">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
            </head>

            <a href="produk/tambah" class="btn btn-info">Tambah Produk</a> &nbsp;&nbsp;
           <br> <br>


            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            <table id="myTable" class="table table-striped" style="width:100%">
                <thead class="table table-hover">
                    <tr>
                        <th width="80px" scope="col" style="text-align:center;">No. </th>
                        
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Material</th>
                        <th>Ukuran</th>
                        <th>Harga</th>
                        <th>Foto Produk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
              
                    @foreach($produk as $as)
                    <tr>
                        <th width="80px" scope="col" style="text-align:center;">{{$loop->iteration}}</th>
                        <td>{{ $as->nama}}</td>
                        <td>{{ $as->kategori}}</td>
                        <td>{{ $as->material}}</td>
                        <td>{{ $as->ukuran}}</td>
                        <td>{{ $as->harga}}</td>
                        <td><br><img class="img" width="100px" src="../image/{{$as->gambar_produk}}"></td>
                        <td>
                        <a class="fas fa-edit" style="color:orange"   href="produk/edit/{{$as->id}}"></a>
                            &nbsp;&nbsp;&nbsp;
                        <a class="fas fa-trash" style="color:red" href="produk/hapus/{{$as->id}}"
                                onclick="return confirm('Apakah anda yakin data ini akan dihapus?')"></a>
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
</style>

<style>
    .section .section-header h1 {
        color: white;
    }

    .section .section-header {        
        background-color:cadetblue;
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
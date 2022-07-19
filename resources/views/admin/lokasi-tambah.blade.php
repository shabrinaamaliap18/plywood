@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <br><h1>Tambah Ongkir</h1><br>
            </div>
            <form method="post" action="/ongkir" enctype="multipart/form-data">
            {{ csrf_field() }}


                <div class="table">

                <div class="form-group">
                    <label for="judul">Nama Kota</label>
                    <input type="text" class="form-control" id="nama_kota" placeholder="Masukkan nama kota baru" name="nama_kota" required>
                </div>

                <div class="form-group">
                    <label for="judul">Alat Angkut</label>
                    <input type="text" class="form-control" id="alat_angkut" placeholder="Masukkan nama kota baru" name="alat_angkut" required>
                </div>

                <div class="form-group">
                    <label for="judul">Harga Ongkir</label>
                    <input type="number" class="form-control" id="harga_ongkir" placeholder="Masukkan harga ongkir baru" name="harga_ongkir">
                </div>


                <button type="submit" class="btn btn-success">Tambah Ongkir</button>
                <a href="/ongkir" class="btn btn-info">Kembali</a>
            </form>

        </div>
    </div>
</div>


<style>
    .section .section-header h1 {
        color: white;
    }

    .section .section-header {
        background-color:cadetblue;
        border-radius: 8px;
    }
</style>

@endsection

@push('page-scripts')
@endpush

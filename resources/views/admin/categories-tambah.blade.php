@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <br><h1>Tambah Kategori</h1><br>
            </div>
            <form method="post" action="/categories" enctype="multipart/form-data">
            {{ csrf_field() }}


                <div class="table">
              

                <div class="form-group">
                    <label for="judul">Nama Kategori</label>
                    <input type="text" class="form-control" id="nama_kategori" placeholder="Masukkan nama kategori baru" name="nama_kategori" required>
                </div>

                <div class="form-group">
                    <label for="judul">Keterangan Kategori</label>
                    <input type="text" class="form-control" id="keterangan_kategori" placeholder="Masukkan keterangan kategori baru" name="keterangan_kategori" required>
                </div>

                <div class="form-group">
                    <label for="judul">Stok</label>
                    <input type="number" class="form-control" id="stok" placeholder="Masukkan jumlah stok baru" name="stok" required>
                </div>

                <div class="form-group">
                    <label for="gambar">Foto Kategori</label>
                    <input type="file" class="form-control-file" id="foto_kategori" placeholder="Masukkan foto" name="foto_kategori" required>
                </div>

                <button type="submit" class="btn btn-success">Tambah Kategori</button>
                <a href="/categories" class="btn btn-info">Kembali</a>
            </form>

        </div>
    </div>
</div>

<style>
      .section .section-header h1 {
        color: white;
    }

    .section .section-header {
        background-color: cadetblue;
        border-radius: 8px;
    }
</style>

@endsection

@push('page-scripts')
@endpush
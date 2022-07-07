@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <br><h1>Tambah Produk</h1><br>
            </div>
            <form method="post" action="/produk" enctype="multipart/form-data">
              {{ csrf_field() }}


                <div class="table">
              
                <div class="form-group">
                    <label for="judul">Nama</label>
                    <input type="text" class="form-control" id="nama" placeholder="Masukkan nama produk baru" name="nama" required>
                </div>

                <div class="form-group">
                    <label for="judul">Kategori</label>
                    <input type="text" class="form-control" id="kategori" placeholder="Masukkan nama kategori baru" name="kategori" required>
                </div>

                <div class="form-group">
                    <label for="judul">Material</label>
                    <input type="text" class="form-control" id="material" placeholder="Masukkan nama material baru" name="material" required>
                </div>

                <div class="form-group">
                    <label for="judul">Ukuran</label>
                    <input type="text" class="form-control" id="ukuran" placeholder="Masukkan ukuran baru" name="ukuran" required>
                </div>

                <div class="form-group">
                    <label for="judul">Jumlah Ukuran</label>
                    <input type="text" class="form-control" id="jml_ukuran" placeholder="Masukkan jml ukuran baru" name="jml_ukuran" required>
                </div>

                <div class="form-group">
                    <label for="judul">Harga</label>
                    <input type="number" class="form-control" id="harga" placeholder="Masukkan harga produk baru" name="harga" required>
                </div>

                <div class="form-group">
                    <label for="gambar">Foto Material</label>
                    <input type="file" class="form-control-file" id="gambar_produk" placeholder="Masukkan foto" name="gambar_produk">
                </div>
                
                <button type="submit" class="btn btn-success">Tambah Produk</button>
                <a href="/produk" class="btn btn-info">Kembali</a>
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
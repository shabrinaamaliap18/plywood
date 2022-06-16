@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <br><h1>Tambah Material</h1><br>
            </div>
            <form method="post" action="/material" enctype="multipart/form-data">
            {{ csrf_field() }}


            <div class="table">
              
                <div class="form-group">
                    <label for="judul">Nama Material</label>
                    <input type="text" class="form-control" id="nama_material" placeholder="Masukkan nama material baru" name="nama_material" required>
                </div>

                <div class="form-group">
                    <label for="judul">Total Stok</label>
                    <input type="number" class="form-control" id="stok_material" placeholder="Masukkan total stok material" name="stok_material" required>
                </div>

                <div class="form-group">
                    <label for="gambar">Foto Material</label>
                    <input type="file" class="form-control-file" id="foto_material" placeholder="Masukkan foto" name="foto_material">
                </div>

                <button type="submit" class="btn btn-success">Tambah Material</button>
                <a href="/material" class="btn btn-info">Kembali</a>
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
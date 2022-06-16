@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
              <br><br>  <h1>Edit Kategori</h1><br>
            </div>

            <form method="post" enctype="multipart/form-data" action="/categories/{{$categories->id}}">

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="judul">Nama Kategori</label>
                    <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"
                        id="nama_kategori" placeholder="Masukkan nama kategori baru" name="nama_kategori"
                        value="{{$categories->nama_kategori}}">

                    @error('nama_kategori')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Keterangan Kategori</label>
                    <input type="text" class="form-control @error('keterangan_kategori') is-invalid @enderror" id="keterangan_kategori"
                        placeholder="Masukkan keterangan kategori baru" name="keterangan_kategori" value="{{$categories->keterangan_kategori}}" required>
                    @error('keterangan_kategori')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Stok</label>
                    <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok"
                        placeholder="Masukkan stok baru" name="stok" value="{{$categories->stok}}" required>
                    @error('stok')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="image">Foto Kategori</label>

                    <input type="file" class="form-control-file" id="foto_kategori" placeholder="Masukkan foto"
                        name="foto_kategori" value="{{$categories->foto_kategori}}" method="post"
                        enctype="multipart/form-data">

                    @error('foto_kategori')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>



                <button type="submit" class="btn btn-success">Edit Kategori</button>
                <a href="/material" class="btn btn-info">Kembali</a> <br> <br> <br>

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
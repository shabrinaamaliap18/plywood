@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
              <br><br><h1>Edit Produk</h1><br>
            </div>

            <form method="post" enctype="multipart/form-data" action="/produk/{{$produk->id}}">

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="judul">Produk</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                        id="nama" placeholder="Masukkan nama produk baru" name="nama"
                        value="{{$produk->nama}}">

                    @error('nama')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Stok</label>
                    <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok"
                        placeholder="Masukkan harga produk baru" name="stok" value="{{$produk->stok}}" required>
                    @error('stok')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Harga</label>
                    <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga"
                        placeholder="Masukkan stok produk baru" name="harga" value="{{$produk->harga}}" required>
                    @error('harga')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Status</label>
                    <input type="number" class="form-control @error('is_ready') is-invalid @enderror" id="is_ready"
                        placeholder="Masukkan status produk baru" name="is_ready" value="{{$produk->is_ready}}" required>
                    @error('is_ready')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Foto Produk</label>

                    <input type="file" class="form-control-file" id="gambar_produk" placeholder="Masukkan foto"
                        name="gambar_produk" value="{{$produk->gambar_produk}}" method="post"
                        enctype="multipart/form-data">

                    @error('gambar')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-success">Edit Produk</button>
                <a href="/produk" class="btn btn-info">Kembali</a> <br> <br> <br>

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
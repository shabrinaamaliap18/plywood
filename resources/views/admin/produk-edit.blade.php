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
                    <label for="judul">Kategori</label>
                    <input type="text" class="form-control @error('kategori') is-invalid @enderror"
                        id="kategori" placeholder="Masukkan nama kategori baru" name="kategori"
                        value="{{$produk->kategori}}">

                    @error('kategori')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Material</label>
                    <input type="text" class="form-control @error('material') is-invalid @enderror"
                        id="material" placeholder="Masukkan nama material baru" name="material"
                        value="{{$produk->material}}">

                    @error('material')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Ukuran</label>
                    <input type="text" class="form-control @error('ukuran') is-invalid @enderror"
                        id="ukuran" placeholder="Masukkan ukuran baru" name="ukuran"
                        value="{{$produk->ukuran}}">

                    @error('ukuran')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Jumlah Ukuran</label>
                    <input type="text" class="form-control @error('jml_ukuran') is-invalid @enderror"
                        id="jml_ukuran" placeholder="Masukkan jml ukuran baru" name="jml_ukuran"
                        value="{{$produk->jml_ukuran}}">

                    @error('jml_ukuran')
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
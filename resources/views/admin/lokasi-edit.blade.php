@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
              <br><br><h1>Edit Ongkir</h1><br>
            </div>

            <form method="post" enctype="multipart/form-data" action="/ongkir/{{$Ongkir->id}}">

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="judul">Nama Kota</label>
                    <input type="text" class="form-control @error('nama_kota') is-invalid @enderror"
                        id="nama_kota" placeholder="Masukkan nama kota baru" name="nama_kota"
                        value="{{$Ongkir->nama_kota}}">

                    @error('nama_kota')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Ongkir</label>
                    <input type="number" class="form-control @error('harga_ongkir') is-invalid @enderror" id="harga_ongkir"
                        placeholder="Masukkan harga ongkir baru" name="harga_ongkir" value="{{$Ongkir->harga_ongkir}}" required>
                    @error('harga_ongkir')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>



                <button type="submit" class="btn btn-success">Edit Ongkir</button>
                <a href="/ongkir" class="btn btn-info">Kembali</a> <br> <br> <br>

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

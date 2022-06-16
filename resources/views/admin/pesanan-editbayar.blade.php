@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <br><br>
                <h1>Edit Pesanan</h1><br>
            </div>

            @foreach($pesanan2 as $as)
            <form action="/pesanan/updatebayar/{{$as->id}}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="judul">Nama Customer</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Masukkan total harga pesanan" name="name" value="{{$as->name}}" required readonly>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Produk</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan total harga pesanan" name="nama" value="{{ $as->nama}}" required readonly>
                    @error('nama')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Jumlah Pembelian</label>
                    <input type="number" class="form-control @error('jumlah_pesanan') is-invalid @enderror" id="jumlah_pesanan" placeholder="Masukkan total harga pesanan" name="jumlah_pesanan" value="{{$as->jumlah_pesanan}}" required readonly>
                    @error('jumlah_pesanan')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">No Telp</label>
                    <input type="text" class="form-control @error('nohp') is-invalid @enderror" id="nohp" placeholder="Masukkan total harga pesanan" name="nohp" value="{{$as->nohp}}" required readonly>
                    @error('nohp')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Alamat</label>
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Masukkan total harga pesanan" name="alamat" value="{{$as->alamat}}" required readonly>
                    @error('alamat')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Lokasi</label>
                    <input type="text" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi" placeholder="Masukkan total harga pesanan" name="lokasi" value="{{$as->lokasi}}" required readonly>
                    @error('lokasi')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Alat Angkut</label>
                    <input type="number" class="form-control @error('alat_angkut') is-invalid @enderror" id="alat_angkut" placeholder="Masukkan jenis alat angkut" name="alat_angkut" value="{{$as->alat_angkut}}" readonly required>
                    @error('alat_angkut')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Ket</label>
                    <input type="number" class="form-control @error('ket') is-invalid @enderror" id="ket" placeholder="Masukkan ket kendaraan" name="ket" value="{{$as->ket}}" readonly required>
                    @error('ket')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Ongkir</label>
                    <input type="text" class="form-control @error('ongkir') is-invalid @enderror" id="ongkir" placeholder="Masukkan total harga pesanan" name="ongkir" value="{{$as->ongkir}}" required readonly>
                    @error('ongkir')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="judul">Status</label>
                    <input type="number" class="form-control @error('status') is-invalid @enderror" id="status" placeholder="Masukkan status pesanan" name="status" value="{{$as->status}}" required>
                    @error('status')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Total Biaya</label>
                    <input type="number" class="form-control @error('total_harga') is-invalid @enderror" id="total_harga" placeholder="Masukkan total harga pesanan" name="total_harga" value="{{$as->total_harga}}" required>
                    @error('total_harga')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                @endforeach


                <button type="submit" class="btn btn-success">Edit Pesanan</button>
                <a href="pesanan" class="btn btn-info">Kembali</a> <br> <br> <br>
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
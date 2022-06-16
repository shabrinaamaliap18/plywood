@extends('admin.layouts.master')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <br><br>
                <h1>Edit Pesanan</h1><br>
            </div>

            @foreach($custom2 as $as)
            <form action="/customm/updatebayar/{{$as->id}}" method="POST">
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
                    <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori" placeholder="Masukkan total harga pesanan" name="nama_kategori" value="{{ $as->nama_kategori}}" required readonly>
                    @error('nama')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Jumlah Pembelian</label>
                    <input type="number" class="form-control @error('jumlah_pesanan_cus') is-invalid @enderror" id="jumlah_pesanan_cus" placeholder="Masukkan total harga pesanan" name="jumlah_pesanan_cus" value="{{$as->jumlah_pesanan_cus}}" required readonly>
                    @error('jumlah_pesanan_cus')
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
                    <input type="number" class="form-control @error('alat_angkut_cus') is-invalid @enderror" id="alat_angkut_cus" placeholder="Masukkan jenis alat angkut" name="alat_angkut_cus" value="{{$as->alat_angkut_cus}}" readonly required>
                    @error('alat_angkut_cus')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Ket</label>
                    <input type="number" class="form-control @error('ket_cus') is-invalid @enderror" id="ket_cus" placeholder="Masukkan ket_cus kendaraan" name="ket_cus" value="{{$as->ket_cus}}" readonly required>
                    @error('ket_cus')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Ongkir</label>
                    <input type="number" class="form-control @error('ongkir_cus') is-invalid @enderror" id="ongkir_cus" placeholder="Masukkan ongkir pesanan" name="ongkir_cus" value="{{$as->ongkir_cus}}"  readonly required>
                    @error('ongkir_cus')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Status</label>
                    <input type="number" class="form-control @error('status_cus') is-invalid @enderror" id="status_cus" placeholder="Masukkan status pesanan" name="status_cus" value="{{$as->status_cus}}"  required>
                    @error('status_cus')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Total Biaya</label>
                    <input type="number" class="form-control @error('total_harga_cus') is-invalid @enderror" id="total_harga_cus" placeholder="Masukkan total harga pesanan" name="total_harga_cus" value="{{$as->total_harga_cus}}" readonly required>
                    @error('total_harga_cus')
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
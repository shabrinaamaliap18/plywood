@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <br><br>
                <h1>Edit Pesanan</h1><br>
            </div>

            <form action="/pesanan/update/{{$pesanan->id}}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="judul">Nama Customer</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Masukkan total harga pesanan" name="name" value="{{$pesanan->user->name}}" required readonly>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Detail Produk {{$pesanan->kode_pemesanan}}</div>
                    <div class="panel-body">
                        <div class="row">
                                @foreach ($pesanan->pesanan_details as $produk)
                                <div class="col-12 mb-4" style="border-bottom: 1px solid rgb(216, 216, 216);">
                                    <div class="form-group">
                                        <label for="judul">Produk</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Produk" name="nama"
                                        value="{{ str_replace(array('[','"',']'),'',$produk->product->nama)}}" required readonly>
                                        @error('nama')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="judul">Ukuran</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan total harga pesanan" name="nama"
                                        value="{{ $produk->product->ukuran }}" readonly>
                                        @error('nama')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <input type="hidden" name="ids[]" value="{{$produk->id}}" />

                                    <div class="form-group">
                                        <label for="judul">Harga</label>
                                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" placeholder="Masukkan harga" name="harga_{{$produk->id}}" value="{{$produk->harga}}"readonly required>
                                        @error('total_harga')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="judul">Jumlah Pembelian</label>
                                        <input type="number" class="form-control @error('jumlah_pesanan') is-invalid @enderror" id="jumlah_pesanan" placeholder="Masukkan total harga pesanan" name="jumlah_pesanan" value="{{$produk->jumlah_pesanan}}" required readonly>
                                        @error('jumlah_pesanan')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                @endforeach

                            </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="judul">No Telp</label>
                    <input type="text" class="form-control @error('nohp') is-invalid @enderror" id="nohp" placeholder="Masukkan total harga pesanan" name="nohp" value="{{$pesanan->user->nohp}}" required readonly>
                    @error('nohp')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Alamat</label>
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Masukkan total harga pesanan" name="alamat" value="{{$pesanan->user->alamat}}" required readonly>
                    @error('alamat')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Lokasi</label>
                    <input type="text" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi" placeholder="Masukkan total harga pesanan" name="lokasi" value="{{$pesanan->user->lokasi}}" required readonly>
                    @error('lokasi')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Alat Angkut</label>
                    <select class="form-control" style="height:max-content" id="alat_angkut" name="alat_angkut" placeholder="Pilih Alat Angkut" >
                        <option value="" disabled> Pilih Alat Angkut</option>

                        @foreach ($ongkirs as $ongkir)
                        <option {{ ($pesanan->alat_angkut) == $ongkir->alat_angkut ? 'selected="true"' : '' }} value="{{ $ongkir->alat_angkut }}">
                            {{ $ongkir->alat_angkut }}
                        </option>
                        @endforeach

                    </select>
                    @error('alat_angkut')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Ket</label>
                    <input type="text" class="form-control @error('ket') is-invalid @enderror" id="ket" placeholder="Masukkan ket kendaraan" name="ket" value="{{$pesanan->ket}}" required>
                    @error('ket')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Ongkir</label>
                    <input type="number" class="form-control @error('ongkir') is-invalid @enderror" id="ongkir" placeholder="Masukkan ongkir pesanan" name="ongkir" value="{{$pesanan->ongkir}}" readonly required>
                    @error('ongkir')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Status</label>
                    <select class="form-control" style="height:max-content" id="status" name="status" placeholder="Pilih Status Pesanan">
                        <option selected value="" disabled selected> Pilih Status Pesanan</option>
                          <option {{ ($pesanan -> status) == '3' ? 'selected' : '' }} value="3">
                          3 - Produk Telah Dikirim
                        </option>
                        <option {{ ($pesanan -> status) == '4' ? 'selected' : '' }} value="4">
                        4 - Produk Telah Sampai Ditempat Tujuan
                        </option>
                    </select>
                    @error('status')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Total Biaya</label>
                    <input type="number" class="form-control @error('total_harga') is-invalid @enderror" id="total_harga" placeholder="Masukkan total harga pesanan" name="total_harga" value="{{$pesanan->total_harga}}"readonly  required>
                    @error('total_harga')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Edit Pesanan</button>
                <a href="/pesanan" class="btn btn-info">Kembali</a> <br> <br> <br>
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

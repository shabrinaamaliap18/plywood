@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class=" section-header">
        <br><br>
        <h1>Edit Pesanan</h1><br>
    </div>
    <div class="row">
        <div class="col-12">

            <form action="/customm/update/{{$as->id}}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="judul">Nama Customer</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Masukkan total harga pesanan" name="name" value="{{$as->user->name}}" required readonly>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Detail Produk</div>
                    <div class="panel-body">
                        <div class="row">
                            @foreach ($as->custom_details as $produk)
                                <div class="col-12 mb-4" style="border-bottom: 1px solid rgb(216, 216, 216);">
                                    <div class="form-group">
                                        <label for="judul">Produk</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Produk" name="nama"
                                        value="{{ str_replace(array('[','"',']'),'',$produk->kategory->nama_kategori)}}" required readonly>
                                        @error('nama')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="judul">Ukuran</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan total harga pesanan" name="nama"
                                        value="{{ $produk->ukuran }}" required readonly>
                                        @error('nama')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <input type="hidden" name="ids[]" value="{{$produk->id}}" />

                                    <div class="form-group">
                                        <label for="judul">Harga</label>
                                        <input type="number" class="form-control @error('jumlah_pesanan_cus') is-invalid @enderror" id="harga_cus" placeholder="Masukkan harga cus" name="harga_cus_{{$produk->id}}" value="{{$produk->harga_cus}}" required>
                                        @error('harga_cus')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="judul">Jumlah Pembelian</label>
                                        <input type="number" class="form-control @error('jumlah_pesanan_cus') is-invalid @enderror" id="jumlah_pesanan_cus" placeholder="Masukkan total harga pesanan" name="jumlah_pesanan_cus" value="{{$produk->jumlah_pesanan_cus}}" required readonly>
                                        @error('jumlah_pesanan_cus')
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
                    <input type="text" class="form-control @error('nohp') is-invalid @enderror" id="nohp" placeholder="Masukkan total harga pesanan" name="nohp" value="{{$as->user->nohp}}" required readonly>
                    @error('nohp')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Alamat</label>
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Masukkan total harga pesanan" name="alamat" value="{{$as->user->alamat}}" required readonly>
                    @error('alamat')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Lokasi</label>
                    <input type="text" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi" placeholder="Masukkan total harga pesanan" name="lokasi" value="{{$as->user->lokasi}}" required readonly>
                    @error('lokasi')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Alat Angkut</label>
                    <input type="text" class="form-control @error('alat_angkut_cus') is-invalid @enderror" id="alat_angkut_cus" placeholder="Masukkan jenis alat angkut" name="alat_angkut_cus" value="{{$as->alat_angkut_cus}}" required>
                    @error('alat_angkut_cus')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Ket</label>
                    <input type="text" class="form-control @error('ket_cus') is-invalid @enderror" id="ket_cus" placeholder="Masukkan ket_cus kendaraan" name="ket_cus" value="{{$as->ket_cus}}" required>
                    @error('ket_cus')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Ongkir</label>
                    <input type="number" class="form-control @error('ongkir_cus') is-invalid @enderror" id="ongkir_cus" placeholder="Masukkan harga ongkir" name="ongkir_cus" value="{{$as->ongkir_cus}}" required>
                    @error('ongkir_cus')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="judul">Status</label>
                    <input type="number" class="form-control @error('status') is-invalid @enderror" id="status" placeholder="Masukkan status pesanan" name="status_cus" value="{{$as->status_cus}}" readonly required>
                    @error('status')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- <div class="form-group">
                    <label for="judul">Total Biaya</label>
                    <input type="number" class="form-control @error('total_harga_cus') is-invalid @enderror" id="total_harga_cus" placeholder="Masukkan total harga pesanan" name="total_harga_cus" value="{{$as->total_harga_cus}}" required>
                    @error('total_harga_cus')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div> --}}


                <button type="submit" class="btn btn-success">Edit Pesanan</button>
                <a href="/customm" class="btn btn-info">Kembali</a> <br> <br> <br>
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
<script>

</script>
@endsection

@push('page-scripts')
@endpush

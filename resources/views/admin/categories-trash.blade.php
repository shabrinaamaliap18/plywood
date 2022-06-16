@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <h1 class="list">Daftar Pegawai</h1>


            <div class="row">
                <form action="/pegawai" method="get" class="form-inline">
                    @csrf
                    <div class="col-12">
                        <!-- <input type="text" class="form-control" name="q" placeholder="Cari buku disini"
                            value="{{ old('search') }}">
                        <button type="submit" class="btn btn-primary my-3" value="search">Cari Buku</button> -->
                </form>

                <br>
                <a href="/pegawai/kembalikan_semua" class="btn btn-success btn-sm"
                    onclick="return confirm('Apakah anda yakin data ini akan dikembalikan semua?')">Kembalikan
                    Semua</a>&nbsp;&nbsp;

                <br><br>


                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif

                <table class="table">
                    <thead class="table-light">
                        <!-- <tr style="background-color: #ADD8E6;"> -->
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">ID</th>
                            <th scope="col">Nama pegawai</th>
                            <th scope="col">NIP</th>
                            <th scope="col">NIK</th>
                            <th scope="col">Jenis_Kelamin</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">Foto Pegawai</th>
                            <th width="250px" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    </thead>

                    <tbody>
                        @foreach($pegawai as $as)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{ $as->id}}</td>
                            <td>{{ $as->nama_pegawai}}</td>
                            <td>{{ $as->NIP}}</td>
                            <td>{{ $as->NIK}}</td>
                            <td>{{ $as->jenis_kelamin}}</td>
                            <td>{{ $as->tanggal_lahir}}</td>
                            <td><br><img class="img" width="70" src="image/{{$as->foto_pegawai}}"></td>
                            <td>
                                <a class="btn btn-info btn-sm" href="/pegawai/kembalikan/{{$as->id}}"
                                    onclick="return confirm('Apakah anda yakin untuk mengembalikan data ini?')">Kembalikan</a>
                                &nbsp;&nbsp;

                            </td>

                        </tr>
                        @endforeach


                    </tbody>
                    <table>
            </div>
        </div>

    </div>


    @endsection

    @push('page-scripts')
    @endpush
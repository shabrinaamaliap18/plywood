@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <h1 class="list">Daftar Menu</h1>


            <div class="row">
                <form action="/menu" method="get" class="form-inline">
                    @csrf
                    <div class="col-12">
                        <!-- <input type="text" class="form-control" name="q" placeholder="Cari buku disini"
                            value="{{ old('search') }}">
                        <button type="submit" class="btn btn-primary my-3" value="search">Cari Buku</button> -->
                </form>

                <br>
                <a href="/menu/kembalikan_semua" class="btn btn-success btn-sm"
                    onclick="return confirm('Apakah anda yakin data ini akan dikembalikan semua?')">Kembalikan
                    Semua</a>&nbsp;&nbsp;

                <br><br>


                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif

                <table class="table">
                    <thead class="table table-hover">
                        <tr>
                            <th width="50px">No.</th>
                            <th width="50px">Nama Menu</th>
                            <th width="50px">Level Menu</th>
                            <th width="50px">Master Menu</th>
                            <th width="50px">Url</th>
                            <th width="50px">Aktif</th>
                            <th width="50px">No. Urut</th>
                            <th width="100px">Aksi</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach($menu as $as)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{ $as->nama_menu}}</td>
                            <td>{{ $as->level_menu}}</td>
                            <td>{{ $as->master_menu}}</td>
                            <td>{{ $as->url}}</td>
                            <td>{{ $as->aktif}}</td>
                            <td>{{ $as->no_urut}}</td>

                            <td>
                                <a class="btn btn-info btn-sm" href="/menu/kembalikan/{{$as->id}}"
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
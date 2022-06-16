@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <br><h1>Tambah User Admin</h1><br>
            </div>
            <form method="post" action="/admin" enctype="multipart/form-data">
            {{ csrf_field() }}


                <div class="table">
              

                <div class="form-group">
                    <label for="judul">Nama Admin</label>
                    <input type="text" class="form-control" id="name" placeholder="Masukkan nama admin baru" name="name" required>
                </div>

                <div class="form-group">
                    <label for="judul">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Masukkan username admin baru" name="username" required>
                </div>

                <div class="form-group">
                    <label for="judul">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Masukkan email baru" name="email" required>
                </div>

                <div class="form-group">
                    <label for="judul">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Masukkan password baru" name="password" required>
                </div>

                <div class="form-group">
                    <label for="gambar">Foto Admin</label>
                    <input type="file" class="form-control-file" id="foto_admin" placeholder="Masukkan foto" name="foto_admin" required>
                </div>

                <button type="submit" class="btn btn-success">Tambah Admin</button>
                <a href="/admin" class="btn btn-info">Kembali</a>
            </form>

        </div>
    </div>
</div>



@endsection

@push('page-scripts')
@endpush
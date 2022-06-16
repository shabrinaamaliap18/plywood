@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
              <br><br>  <h1>Edit User Admin</h1><br>
            </div>

            <form method="post" enctype="multipart/form-data" action="{{$admin->id}}">

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="judul">Nama Admin</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        id="name" placeholder="Masukkan nama admin baru" name="name"
                        value="{{$admin->name}}">

                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                        placeholder="Masukkan username admin baru" name="username" value="{{$admin->username}}" required>
                    @error('username')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        placeholder="Masukkan email baru" name="email" value="{{$admin->email}}" required>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        placeholder="Masukkan password baru" name="password" value="{{$admin->password}}" required>
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="image">Foto Admin</label>

                    <input type="file" class="form-control-file" id="gambar" placeholder="Masukkan foto"
                        name="gambar" value="{{$admin->gambar}}" method="post"
                        enctype="multipart/form-data">

                    @error('gambar')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>



                <button type="submit" class="btn btn-success">Edit Admin</button>
                <a href="/admin" class="btn btn-info">Kembali</a> <br> <br> <br>

            </form>



           
        </div>
    </div>
</div>
@endsection

@push('page-scripts')
@endpush
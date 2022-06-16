@extends('layouts.app')
@section('content')
<div class="y" style="background-image: url(../image/register.jpg);
   background-repeat: no-repeat;
   background-size:100%; color: white">
    <br><br><br><br>
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card" style="background-color:rgba(0, 0, 0, 0.5);">
                    <h3 class="card-header text-center">{{ __('REGISTER') }}</h3>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="nama_perusahaan" class="col-md-4 col-form-label text-md-right">{{ __('Nama Perusahaan') }}</label>

                                <div class="col-md-6">
                                    <input id="nama_perusahaan" type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror" style="background-color:rgba(0, 0, 0, 0.5); color: white" name="nama_perusahaan" value="{{ old('name') }}" required autocomplete="nama_perusahaan" autofocus>

                                    @error('nama_perusahaan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama Lengkap') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" style="background-color:rgba(0, 0, 0, 0.5); color: white" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" style="background-color:rgba(0, 0, 0, 0.5); color: white" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lokasi" class="col-md-4 col-form-label text-md-right">{{ __('Lokasi') }}</label>

                                <div class="col-md-6">
                                    <select style="background-color:rgba(0, 0, 0, 0.5); color: white" class="form-control" id="lokasi" name="lokasi" placeholder="Pilih Lokasi">
                                        <option selected value="" disabled selected> Pilih Lokasi</option>
                                        <option value="Surabaya">Surabaya
                                        </option>
                                        <option value="Jakarta">Jakarta
                                        </option>
                                        <option value="Mojokerto">Mojokerto
                                        </option>
                                        <option value="Probolinggo">Probolinggo
                                        </option>
                                        <option value="Pasuruan">Pasuruan
                                        </option>
                                    </select>

                                    @error('lokasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat" class="col-md-4 col-form-label text-md-right">{{ __('Alamat Lengkap') }}</label>

                                <div class="col-md-6">
                                    <input id="alamat" type="alamat" class="form-control @error('alamat') is-invalid @enderror" style="background-color:rgba(0, 0, 0, 0.5); color: white" name="alamat" value="{{ old('alamat') }}" required autocomplete="alamat">

                                    @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nohp" class="col-md-4 col-form-label text-md-right">{{ __('Nomor HP') }}</label>

                                <div class="col-md-6">
                                    <input id="nohp" type="number" class="form-control @error('nohp') is-invalid @enderror" style="background-color:rgba(0, 0, 0, 0.5); color: white" name="nohp" value="{{ old('nohp') }}" required autocomplete="nohp">

                                    @error('nohp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" style="background-color:rgba(0, 0, 0, 0.5); color: white" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" style="background-color:rgba(0, 0, 0, 0.5); color: white" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br>
</div>
@endsection
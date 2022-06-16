@extends('layouts.master')
@section('title', 'Laravel')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <h1>Tambah Menu</h1>
            </div>

            <form method="post" action="/menu" enctype="multipart/form-data">
                @csrf


                <div class="form-group">
                    <label for="nama_menu">Nama Menu</label>
                    <input type="text" class="form-control @error('nama_menu') is-invalid @enderror" id="nama_menu" placeholder="Masukkan nama menu baru" name="nama_menu" required>

                    @error('nama_menu')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="level_menu">Pilih Level Menu</label>
                    <select class="form-control @error('level_menu') is-invalid @enderror " id="level_menu" name="level_menu" required>
                        <option selected>Pilih Level Menu</option>
                        <option value="main_menu">Main Menu</option>
                        <option value="sub_menu">Sub Menu </option>
                    </select>

                    @error('level_menu')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <select name="master_menu" class="form-control" id="master_menu">
                        <option value="">Pilih Main Menu</option>
                        @foreach ($master_menu as $master_menu) <option value="{{ $master_menu->id}} ">
                            {{$master_menu->id}} -
                            {{$master_menu->nama_menu}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group">
                    <label for="url">Url</label>
                    <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" placeholder="Masukkan Url baru" name="url" required>
                    @error('url')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="icon">Icon</label>
                    <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" placeholder="Masukkan Icon baru" name="icon" required>
                    @error('icon')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="aktif">Apakah Menu Aktif?</label>
                    <select class="form-control @error('aktif') is-invalid @enderror" id="aktif" name="aktif" required>
                        <option value="Y">Ya</option>
                        <option value="N">Tidak</option>
                    </select>
                    @error('aktif')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul">No Urut</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="no_urut" placeholder="Masukkan no urut baru" name="no_urut" required>
                    @error('judul')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
                <script type='text/javascript'>
                    $(window).load(function() {
                        $("#level_menu").change(function() {
                            console.log($("#level_menu option:selected").val());
                            if ($("#level_menu option:selected").val() == 'main_menu') {
                                $('#master_menu').prop('hidden', 'true');
                            } else {
                                $('#master_menu').prop('hidden', false);
                            }
                        });
                    });
                </script>
        </div>
    </div>


    <button type="submit" class="btn btn-success">Tambah Menu</button>
    <a href="/menu" class="btn btn-info">Kembali</a>



    </form>


</div>

</div>
</div>

@endsection

@push('page-scripts')
@endpush
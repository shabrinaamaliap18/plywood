@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
                <h1>Edit Menu</h1>
            </div>

            @if (session('status'))
            <div class="alert alert-info">
                {{ session('status') }}
            </div>
            @endif


            <br>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Perhatian!</strong> Melakukan pengubahan dan penghapusan menu tidak bisa dilakukan jika menu
                sedang diakses!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" action="/menu/update/{{$menu->id}}">

                {{ csrf_field() }}
                {{ method_field('PUT') }}


                <div class="form-group">
                    <label for="nama_menu">Nama Menu</label>
                    <input type="text" class="form-control" id="nama_menu" placeholder="Masukkan nama menu baru"
                        name="nama_menu" value=" {{ $menu->nama_menu }}" required>
                </div>

                <div class="form-group">
                    <label for="level_menu">Level Menu</label>
                    <select class="form-control" id="level_menu" name="level_menu" required>

                        <option {{ ($menu -> level_menu) == 'main_menu' ? 'selected' : '' }} value="main_menu"> Main
                            Menu </option>
                        <option {{ ($menu -> level_menu) == 'sub_menu' ? 'selected' : '' }} value="sub_menu"> Sub Menu
                        </option>

                    </select>
                </div>



                <div class="form-group">

                    <select name="master_menu" class="form-control" id="master_menu">
                        <option value="">Pilih Main Menu</option>
                        @foreach ($master_menu as $master_menu)

                        <option value="{{ $master_menu->id}}" @if($master_menu->id==$menu->master_menu)
                            selected='selected'
                            @endif >{{ $master_menu->id}} - {{ $master_menu->nama_menu}}</option>
                        @endforeach
                    </select>


                </div>

                <div class="form-group">
                    <label for="url">Url</label>
                    <input type="text" class="form-control" id="url" placeholder="Masukkan Url baru" name="url"
                        value=" {{ $menu->url }}" required>
                </div>

                <div class="form-group">
                    <label for="icon">Icon</label>
                    <input type="text" class="form-control" id="icon" placeholder="Masukkan Icon baru" name="icon"
                        value=" {{ $menu->icon }}" required>
                </div>

                <div class="form-group">
                    <label for="aktif">Aktif</label>
                    <select class="form-control" id="aktif" name="aktif" required>
                        <option {{ ($menu -> aktif) == 'Y' ? 'selected' : '' }} value="Y"> Ya </option>
                        <option {{ ($menu -> aktif) == 'N' ? 'selected' : '' }} value="N"> Tidak </option>

                    </select>
                </div>

                <div class="form-group">
                    <label for="judul">No Urut</label>
                    <input type="text" class="form-control" id="no_urut" placeholder="Masukkan no urut baru"
                        name="no_urut" value=" {{ $menu->no_urut }}" required>
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


    <button type="submit" class="btn btn-success">Edit Menu</button>
    <a href="/menu" class="btn btn-info">Kembali</a>
    </form>


</div>
</div>
</div>

@endsection

@push('page-scripts')
@endpush
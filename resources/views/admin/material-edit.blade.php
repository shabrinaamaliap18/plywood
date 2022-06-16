@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class=" section-header">
              <br><br>  <h1>Edit Material</h1><br>
            </div>

            <form method="post" enctype="multipart/form-data" action="/material/{{$material->id}}">

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="judul">Nama Material</label>
                    <input type="text" class="form-control @error('nama_material') is-invalid @enderror"
                        id="nama_material" placeholder="Masukkan nama material baru" name="nama_material"
                        value="{{$material->nama_material}}">

                    @error('nama_material')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

            

                <div class="form-group">
                    <label for="judul">Total Stok</label>
                    <input type="number" class="form-control @error('stok_material') is-invalid @enderror" id="stok_material"
                        placeholder="Masukkan stok material" name="stok_material" value="{{$material->stok_material}}" required>
                    @error('stok_material')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="image">Foto Material</label>

                    <input type="file" class="form-control-file" id="gambar_material" placeholder="Masukkan foto"
                        name="gambar_material" value="{{$material->gambar}}" method="post"
                        enctype="multipart/form-data">

                    @error('gambar')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>



                <button type="submit" class="btn btn-success">Edit Material</button>
                <a href="material" class="btn btn-info">Kembali</a> <br> <br> <br>


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
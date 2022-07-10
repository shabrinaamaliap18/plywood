<div class="container">
    <div class="row mt-4 mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Custom Produk</li>
                </ol>
            </nav>

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Perhatian!</strong> Batas ukuran untuk kustom produk adalah Minimal ukuran 9 mm x 1220 mm x 1220 mm dan Maksimal 25 mm x 1220 mm x 1950 mm 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">



                <div class="row">
                    <div class="col">
                        <form action="/custom" method="POST">
                            @csrf
                            <table class="table" style="border-top : hidden">

                                <div class="form-group">
                                    <label for="kategori">Pilih Kategori</label>
                                    <select name="kategori" class="form-control text-center" data-selected-subcategory="{{ old('kategori') }}" required>
                                        <option value="" disabled selected>Pilih Kategori</option>
                                        @foreach ($kategori as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="material">Pilih Material</label>
                                    <select name="material" class="form-control text-center" data-selected-subcategory="{{ old('material') }}" required>
                                        <option value="" disabled selected>Pilih Material</option>
                                        @foreach ($material as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>



                                <div class="form-group">
                                    <label for="judul">Ukuran</label>
                                    <div class="row g-3">
                                    <div class="col-md-2">
                                        <!-- kolom 1 -->
                                        <input type="number" min="9" max="25" id="tebal" name="tebal" class="form-control" placeholder="tebal" class="form-control @error('tebal') is-invalid @enderror" value="{{ old ('tebal')}}">
                                    </div> X
                                    <div class="col-md-2">
                                        <!-- kolom 2 -->
                                        <input type="number" min="1220" max="1220" id="lebar" name="lebar" class="form-control" placeholder="lebar" class="form-control @error('lebar') is-invalid @enderror" value="{{ old ('lebar')}}">
                                    </div> X
                                    <div class="col-md-2">
                                        <!-- kolom 3 -->
                                        <input type="number" min="1220" max="1950" id="panjang" name="panjang" class="form-control" placeholder="panjang" class="form-control @error('panjang') is-invalid @enderror" value="{{ old ('panjang')}}">
                                    </div> 
                                     mm
                                </div>
                                </div>


                                <tr>
                                    <td>Jumlah</td>
                                    <td>:</td>
                                    <td>
                                        <input id="jumlah_pesanan_cus" name="jumlah_pesanan_cus" type="number" class="form-control @error('jumlah_pesanan_cus') is-invalid @enderror" value="{{ old('jumlah_pesanan_cus') }}" autofocus>

                                        @error('jumlah_pesanan_cus')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </td>
                                </tr>



                                <tr>
                                    <td colspan="3">
                                        <button type="submit" class="btn btn-dark btn-block"><i class="fas fa-save"></i> Simpan Custom</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <style>
        .breadcumb_area {
            position: relative;
            z-index: 1;
            width: 100%;
            height: 150px;
        }

        .breadcumb_area .page-title h2 {
            font-size: 33px;
            text-transform: uppercase;
            font-weight: 700;
            font-family: "Ubuntu", sans-serif;
            letter-spacing: 1px;
            margin-bottom: 0;
            font-weight: 600;
        }


        .bg-img {
            background-position: center center;
            background-size: cover;
            background-repeat: no-repeat;

        }

        ::after,
        ::before {
            box-sizing: border-box;
        }

        .breadcumb_area:after {
            background-color: rgba(255, 255, 255, .9);
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            z-index: -5;
            content: '';
        }


        h2,
        h3,
        h5,
        h6 {
            color: #000;
            line-height: 1.3;
            font-weight: 700;
            font-family: "Ubuntu", sans-serif;
        }

        .h5,
        h5 {
            font-size: 1.25rem;
        }
    </style>
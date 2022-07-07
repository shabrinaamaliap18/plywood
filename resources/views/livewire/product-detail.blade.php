
<div class="container">
    <div class="row mt-4 mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar Produk</li>
                </ol>
            </nav>
        </div>
    </div><br>

    <div class="row">
        <div class="col-md-12">
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card gambar-product">
                <div class="card-body">
                    <img src="{{ url('assets/jersey') }}/{{ $product->gambar_produk }}" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h2>
                <strong>{{ $product->nama }}</strong>
            </h2>
           
            <br>
            <div class="row">
                <div class="col">
                    <form wire:submit.prevent="masukkanKeranjang">
                        <table class="table" style="border-top : hidden">

                            <tr>
                                <td>Kategori</td>
                                <td>:</td>
                                <td>{{ $product->kategori }}</td>
                            </tr>
                            <tr>
                                <td>Material</td>
                                <td>:</td>
                                <td>{{ $product->material }}</td>
                            </tr>
                            <tr>
                                <td>Ukuran</td>
                                <td>:</td>
                                <td>{{ $product->ukuran }}</td>
                            </tr>
                            <tr>
                                <td>Jumlah</td>
                                <td>:</td>
                                <td>
                                    <input id="jumlah_pesanan" type="number" class="form-control @error('jumlah_pesanan') is-invalid @enderror" wire:model="jumlah_pesanan" value="{{ old('jumlah_pesanan') }}" required autocomplete="name" autofocus>

                                    @error('jumlah_pesanan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                            </tr>

                            @error('nomor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </td>
                            </tr>

                            <tr>
                                <td colspan="3">
                                    <button type="submit" class="btn btn-dark btn-block"><i class="fas fa-shopping-cart"></i> Masukkan Keranjang</button>
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
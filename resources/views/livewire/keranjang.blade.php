<div class="container">
    <div class="row mt-4 mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if(session()->has('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
            @endif
        </div>
    </div>


    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>

                            <th>No.</th>
                            <th>Gambar</th>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <td><strong>Total Harga</strong></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        @forelse ($pesanan_details as $pesanan_detail)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                <img src="{{ url('assets/jersey') }}/{{ $pesanan_detail->product->gambar_produk }}" class="img-fluid" width="200">
                            </td>
                            <td>
                                {{ $pesanan_detail->product->nama }}
                            </td>

                            <td>
                                <div class="form-group">
                                    <input id="jumlah" name="jumlah_pesanan" type="number" class="form-control @error('jumlah_pesanan') is-invalid @enderror" value="{{ $pesanan_detail->jumlah_pesanan}}" autocomplete="jumlah_pesanan">

                                    @error('jumlah_pesanan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </td>

                            <td id="harga">Rp. {{ number_format($pesanan_detail->product->harga) }}</td>
                            <td id="total"><strong>Rp. {{ number_format($pesanan_detail->total_harga) }}</strong></td>

                            <td>
                                <i wire:click="update({{ $pesanan_detail->id }})" class="fas fa-edit" style="color:orange"></i>
                                &nbsp; &nbsp;
                                <i wire:click="destroy({{ $pesanan_detail->id }})" class="fas fa-trash text-danger"></i>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">Data Kosong</td>
                        </tr>
                        @endforelse

                        @if(!empty($pesanan))
                        <!-- <tr>
                            <td colspan="6" align="right"><strong>Total Harga : </strong></td>
                            <td align="right"><strong>Rp. {{ number_format($pesanan_detail->total_harga) }}</strong> </td>
                            <td></td>
                        </tr> -->

                        <tr>
                            <td colspan="6" align="right"><strong>Ongkir : </strong></td>
                            <td align="right"><strong>Rp. {{ number_format($pesanan->ongkir) }}</strong> </td>
                            <td></td>
                        </tr>

                        <tr>
                            <td colspan="6" align="right"><strong>Total Yang Harus dibayarkan : </strong></td>
                            <td align="right"><strong>Rp. {{ number_format($pesanan->total_harga)}}</strong> </td>
                            <td></td>
                        </tr>
                        <tr>
                          
                            <td colspan="6"></td>
                            <td colspan="2">
                                <a href="{{ route('checkout') }}" class="btn btn-success btn-blok">
                                    <i class="fas fa-arrow-right"></i> Check Out
                                </a>
                            </td>
                        </tr>

                       
                        @endif
                    </tbody>
                </table>
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
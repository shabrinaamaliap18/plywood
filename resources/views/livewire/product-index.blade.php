<div class="container">

<div class="breadcumb_area bg-img" style="background-image:url(https://preview.colorlib.com/theme/essence/img/bg-img/xbreadcumb.jpg.pagespeed.ic.11gX2RXIY8.webp); ">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="page-title text-center">
                    <strong>
                        <h2>DAFTAR PRODUK</h2>
                    </strong>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<div class="container">
    <div class="row mb-2">
        <div class="col">
            <nav aria-label="breadcrumb"><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Daftar Produk</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9" class="d-flex align-items-center">
            @if($search)
            Kamu Mencari "{{ $search }}"
            @endif
        </div>
        <div class="col-md-3">
            <div class="input-group mb-3">
                <input wire:model.debounce.0ms="search" type="text" name="searchh" class="form-control" placeholder="Search . . ." />
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Harga produk adalah harga per m3 (kubik).<strong> Terima Kasih</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>


    <section class="product_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">

            </div>
            <form wire:submit.prevent="masukkanKeranjang">
                <div class="row" style="display:flex !important;">
                    @forelse($products as $row)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="box">
                            <div class="option_container">
                                <div class="options">
                                    <!-- <button href="" class="option1" type="submit" @if($row->is_ready !== 1) disabled @endif>
                                        <i class="fas fa-shopping-cart"></i>
                                    </button> -->
                                    <a href="{{ route('products.detail', $row->id) }}" class="option2">
                                        Detail
                                    </a>
                                </div>
                            </div>
                            <div class="img-box">
                                <img src="{{ url('assets/jersey') }}/{{ $row->gambar_produk }}" alt="">
                            </div>
                            <div class="detail-box">

                                <h5>
                                    <b>{{ $row->nama }}</b>
                                </h5>

                            </div><br>

                            <div class="detail-box-u">

                                <p>
                                    <b> {{ $row->ukuran }} </b>
                                </p>
                            </div><br><br>
                            <div class="detail-box-h" style="text-align: right;">
                                <p>
                                    Rp. {{ number_format($row->harga) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-sm-12">
                        <strong>Opps barang tidak ada.</strong>
                    </div>
                    @endforelse
                </div>
            </form>
            <br>

            <div class="row">
                <div class="col">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </section>
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

    .product_section .heading_container {
        margin-bottom: 20px;
    }


    .detail-box {
        font-size: 20px;

    }

    .detail-box-u {
        font-size: 20px;
        text-align: left;

    }

    .detail-box-h {
        font-size: 18px;
    }

    .product_section .box {
        position: relative;
        margin-top: 25px;
        padding: 35px 35px;
        background-color: #f7f8f9;
        -webkit-transition: all .3s;
        transition: all .3s;
        overflow: hidden;
        box-shadow: 5px 5px 5px -5px rgba(0, 0, 0, .2);
        border: solid #fff 10px;
    }

    .product_section .box .img-box {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        height: 215px;
    }

    .product_section .box .img-box img {
        max-width: 100%;
        max-height: 160px;
        -webkit-transition: all .3s;
        transition: all .3s;
    }

    .product_section .box .detail-box {
        text-align: center;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }

    .product_section .box .detail-box h5 {
        font-size: 18px;
        margin-top: 10px;
    }

    .product_section .box .detail-box h6 {
        margin-top: 10px;
        color: #002c3e;
        font-weight: 600;
    }

    .product_section .box:hover img {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }

    .product_section .box:hover .option_container {
        opacity: 1;
        visibility: visible;
        -webkit-transform: translateY(0);
        transform: translateY(0);
    }


    .product_section .option_container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        background-color: rgba(255, 255, 255, 0.6);
        z-index: 3;
        opacity: 0;
        visibility: hidden;
        -webkit-transition: all .2s;
        transition: all .2s;
        -webkit-transform: translateY(100%);
        transform: translateY(100%);
    }



    .product_section .options {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    .product_section .options a {
        display: inline-block;
        padding: 8px 15px;
        border-radius: 30px;
        width: 165px;
        text-align: center;
        -webkit-transition: all .3s;
        transition: all .3s;
        margin: 5px 0;
    }

    .product_section .options .option1 {
        background-color: #8B4513;
        border: 1px solid #DEB887;
        color: #ffffff;
    }

    .product_section .options .option1:hover {
        background-color: transparent;
        color: #8B4513;
    }

    .product_section .options .option2 {
        background-color: #000000;
        border: 1px solid #000000;
        color: #ffffff;
    }

    .product_section .options .option2:hover {
        background-color: transparent;
        color: #000000;
    }

    .product_section .btn-box {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        margin-top: 45px;
    }

    .product_section .btn-box a {
        display: inline-block;
        padding: 10px 40px;
        background-color: #f7444e;
        border: 1px solid #f7444e;
        color: #ffffff;
        border-radius: 0;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
    }

    .product_section .btn-box a:hover {
        background-color: transparent;
        color: #f7444e;
    }

    .page-item.active .page-link {
        z-index: 3;
        color: #8B4513;
        background-color: #DEB887;
        border-color: #D2B48C;
    }

    .page-link {
        color: #8B4513;
        border-color: #D2B48C;
    }
</style>



</div>

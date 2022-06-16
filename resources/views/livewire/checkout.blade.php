<body>

    <div class="row">
        <div class="col-md-12">
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
        </div>
    </div>


    <div class="breadcumb_area bg-img" style="background-image:url(https://preview.colorlib.com/theme/essence/img/bg-img/xbreadcumb.jpg.pagespeed.ic.11gX2RXIY8.webp); ">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <strong>
                            <h2>CHECKOUT</h2>
                        </strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <form wire:submit.prevent="checkout">

            <div class="row">
                <div class="col-12 col-md-6">


                    @foreach ($pesde as $pesanan_detail)
                    <input type="hidden" id="token_midtrans{{$pesanan_detail->id}}" value="{{$pesanan_detail->kode_midtrans}}">

                    <input type="hidden" id="uniqode{{$pesanan_detail->id}}" value="{{$pesanan_detail->uniqode}}">

                    <br><br>
                    <br>


                    <div class="cart-page-heading">
                        <h5>Detail Pelanggan</h5>
                    </div>
                    <br>

                    <div class="form-group">
                        <label style=" font-size: 14px; font-weight: 600;" readonly>Kode : <strong> {{ $pesanan_detail->kode_pemesanan }}</strong> </label>
                    </div>
                    @break
                    @endforeach



                    @foreach ($pesde2 as $pesanan_detail2)

                    <div class="form-group">
                        <label style=" font-size: 14px; font-weight: 600;" for="">Nama Perusahaan</label><br>
                        <label id="nama_perusahaan" value="">{{ $pesanan_detail2->nama_perusahaan}}</label>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label style=" font-size: 14px; font-weight: 600;" for="">Nama</label><br>
                        <label id="name" value="">{{ $pesanan_detail2->name}}</label>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    @break
                    @endforeach

                    <div class="form-group">
                        <label style=" font-size: 14px; font-weight: 600;" for="">No. HP</label><br>
                        <label id="nohp" value="">{{ $pesanan_detail2->nohp}}</label>

                        @error('nohp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label style=" font-size: 14px;font-weight: 600;" for="">Lokasi</label><br>
                        <label id="lokasi" value="">{{ $pesanan_detail2->lokasi}}</label>

                        @error('lokasi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label style=" font-size: 14px; font-weight: 600;" for="">Alamat</label><br>
                        <label id="alamat" value="">{{ $pesanan_detail2->alamat}}</label>

                        @error('alamat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-5 ml-lg-auto">
                    <br>
                    <br>
                    <div class="order-details-confirmation">
                        <div class="cart-page-heading">
                            <h5>Detail Pesanan</h5>
                        </div>
                        <ul class="order-details-form mb-4">
                            <li> <strong><span>Product</span></strong> <strong> <span>Total</span></strong></li>
                            @foreach ($pesdel as $pesde)
                            <li><span>{{$pesde->nama}}</span> <span>Rp. {{ number_format($pesde->total_harga) }}</span></li>
                            @endforeach

                            <li><span>Ongkir</span>
                                @foreach ($ongkir as $ongkir)
                                @if ($pesanan->lokasi == $ongkir->nama_kota)
                                <span>Rp. {{ number_format($ongkir->harga_ongkir) }}</span>
                            </li>
                            
                            
                            <li><span>Total Harga</span> <strong><span>Rp. {{ number_format($pesanan->total_harga)  }}</span></strong></li>
                            @endif
                            @endforeach


                        </ul>

                    </div>
                    <br>
                </div>



            </div>
            <a onclick="paybutton(<?php echo $pesanan_detail->id ?>)" class="btn btn-warning" style="width:160px; float:right;">Bayar Sekarang</a>
            <div class="row">
                <div class="col">
                    <a href="{{ route('keranjang') }}" style="width:160px; float:right;" class="btn btn-dark">Kembali</a>
                </div>
            </div>



        </form>
    </div>
</body>


<!-- Template Main JS File -->
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#jumlah, #harga").keyup(function() {
            var harga  = $("#harga").val();
            var jumlah = $("#jumlah").val();

            var total = parseInt(harga) * parseInt(jumlah);
            $("#total").val(total);
        });
    });
</script> -->

<script src="assets/js/main.js"></script>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-Du-q1OsWZmCvVaGp"></script>
<script type="text/javascript">
    function paybutton(id) {
        var token = $('#token_midtrans' + id).val();
        var uniqode = $('#uniqode' + id).val();
        window.snap.pay(token, {
            onSuccess: function(result) {
                triggerSuccessPayment();

            },
            onPending: function(result) {
                triggerSuccessPayment();
                location.reload();
            },
            onError: function(result) {
                triggerSuccessPayment();
                location.reload();
            },
            onClose: function() {
                triggerSuccessPayment();

            }
        })
        //alert(token);
    }
</script>


<script>
    window.addEventListener('load', function() {
        @if(Session::has('transaction'));
        location.reload();
        @endif
    })
</script>


<script>
    function triggerSuccessPayment() {
        $.ajax({
            type: 'get',
            url: "{{url('trigger_payment')}}",
            dataType: 'json',
            success: function(data) {
                var temp = [];
                $.each(data, function(key, value) {
                    temp.push({
                        v: value,
                        k: key
                    });
                });
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    }
</script>


<style>
    .order-details-confirmation {
        width: 100%;
        border: 2px solid #ebebeb;
        padding: 40px;
    }

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

    .ul {
        display: block;
        list-style-type: disc;
        margin-block-start: 1em;
        margin-block-end: 1em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
        padding-inline-start: 40px;
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

    .order-details-confirmation .order-details-form li {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -ms-grid-row-align: center;
        align-items: center;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        margin-bottom: 0;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        padding: 20px 0;
        border-bottom: 2px solid #ebebeb;
    }

    .mb-4 {
        margin-bottom: 1.5rem !important;
    }

    .ul {
        margin: 0;
    }
</style>
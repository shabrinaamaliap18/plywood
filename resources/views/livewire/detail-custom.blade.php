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
        <div class="row">
            <div class="col-12 col-md-6">


                @forelse ($custom_details as $custom_detail)
                <input type="hidden" id="token_midtrans{{$custom_detail->id}}" value="{{$custom_detail->kode_midtrans}}">
                <input type="hidden" id="uniqode{{$custom_detail->id}}" value="{{$custom_detail->uniqode}}">

                <br><br>
                <br>


                <div class="cart-page-heading">
                    <h5>Detail Pelanggan</h5>
                </div>
                <br>

                <div class="form-group">
                    <label style=" font-size: 14px; font-weight: 600;">Kode : <strong> {{ $custom_detail->kode_pemesanan_cus }}</strong> </label>
                </div>
                @break
                @endforeach


                <div class="form-group">
                    <label style=" font-size: 14px; font-weight: 600;" for="">Nama</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" value="{{ old('name') }}" autocomplete="name" readonly>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label style=" font-size: 14px; font-weight: 600;" for="">No. HP</label>
                    <input id="nohp" type="text" class="form-control @error('nohp') is-invalid @enderror" wire:model="nohp" value="{{ old('nohp') }}" autocomplete="nohp" readonly>

                    @error('nohp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label style=" font-size: 14px;font-weight: 600;" for="">Lokasi</label>
                    <input wire:model="lokasi" type="text" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi') }}" autocomplete="lokasi" readonly></input>

                    @error('lokasi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label style=" font-size: 14px; font-weight: 600;" for="">Alamat</label>
                    <textarea wire:model="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}" autocomplete="alamat" readonly></textarea>

                    @error('alamat')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-5 ml-lg-auto">
                <form wire:submit.prevent="checkout">
                    <br>
                    <br>
                    <div class="order-details-confirmation">
                        <div class="cart-page-heading">
                            <h5>Detail Pesanan</h5>
                        </div>
                        <ul class="order-details-form mb-4">
                            <li> <strong><span>Product</span></strong> <strong> <span>Total</span></strong></li>
                            @foreach ($custom_details as $custom_detail)
                            <li><span>{{ $custom_detail->nama_kategori}}</span> <span>Rp. {{ number_format($custom_detail->harga_cus) }}</span></li>
                            @endforeach
                            <li><span>Ongkir</span> <span>Rp. {{ number_format($custom_detail->ongkir_cus) }}</span></li>
                            <li><span>Ukuran</span> <span> {{ $custom_detail->ukuran}}</span></li>
                            <li><span>Total Harga</span> <strong><span>Rp. {{ number_format($custom_detail->total_harga_cus) }}</span></strong></li>
                        </ul>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                           Harap tunggu beberapa saat untuk konfirmasi total harga dan ongkir dari admin. Ketika telah terisi, silahkan lanjutkan pembayaran.</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    </div>
                    <br>
            </div>

        </div>
        <a onclick="paybutton(<?php echo $custom_detail->id ?>)" class="btn btn-warning" style="width:160px; float:right;">Bayar Sekarang</a>
        <div class="row">
            <div class="col">
                <a href="{{ route('keranjang') }}" style="width:160px; float:right;" class="btn btn-dark">Kembali</a>
            </div>
        </div>



        </form>
    </div>
    </div>
    </div>



    <!-- Template Main JS File -->
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
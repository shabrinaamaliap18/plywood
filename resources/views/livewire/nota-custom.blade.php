<head>
    <meta charset="utf-8">
    <title>Nota Perusahaan</title>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <h3 style="text-align: center; text-decoration: underline;"> NOTA PERUSAHAAN</h3>
                                <p style="text-align: center; line-height: 0.2em"> 07/MAS/NP/VIII/2021</p>
                                <p class="img" style="text-align: right; line-height: 2px">
                                    <img src="{{ public_path('image/legal - Copy.png') }}" />
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            {{-- @foreach ($order as $order) --}}
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <strong>ASAL KAYU</strong><br>
                                CV Mirai Alam Sejahtera<br>
                                (0334) 889171<br>
                                Jl. Semeru No.227, Srebet, Purwosono<br> Lumajang<br>
                                {{$order->alat_angkut}}<br>
                                {{$order->ket}}
                            </td>

                            <td>
                                <strong>TUJUAN</strong><br>
                                @if ($order->user)
                                {{ $order->user->nama_perusahaan }}<br>
                                {{ $order->user->name }}<br>
                                {{ $order->user->alamat }}<br>
                                {{ $order->user->lokasi}}
                                {{ $order->user->nohp }}<br>
                                @endif
                            </td>


                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Produk</td>
                <td>Subtotal</td>
            </tr>

            <tr class="item">
                <td>

                    <strong>Jenis Kayu Olahan:</strong>&nbsp;
                    {{ $order->material->nama_material }}<br>
                    <strong>Jumlah:</strong>&nbsp;
                    {{ $order->jumlah_pesanan_cus }}
                    <br>
                    <strong>Ukuran:</strong>&nbsp;
                    {{ $order->ukuran_cus }}
                    <!-- {{ ($order->jumlah_pesanan * $order->jml_ukuran / 1000000000) }} -->
                </td>
                <td>Rp {{ number_format($order->total_harga_cus)}}</td>
            </tr>

            <tr class="total">
                <td></td>
                <td>
                    Subtotal: Rp {{ number_format($order->total_harga_cus) }}
                </td>
            </tr>
            {{-- @endforeach --}}

<br>
<br>
<br>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <h5 style="text-align: right; line-height: 0.2em;"> Lumajang, {{date('Y-m-d',strtotime($order->tanggal_transaksi_cus))}} </h5>
                                    <h5 style="text-align: right;line-height: 0.2em;"> CV. Mirai Alam Sejahtera</h5>
                                    <br><br><br><br><br>
                                    <h5 style="text-align: right;  text-decoration: underline;"> SUMADI HERIYANTO</h5>
                                <p style="text-align: right; line-height: 0px; font-size:14px"> No. Reg. 08200001833</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- @if ($order->payment)
            <tr class="total">
                <td></td>
                <td>
                   Pembayaran: Rp -{{ number_format($order->payment->amount) }}
                </td>
            </tr>
            <tr>
                <td><strong>Detail Pembayaran</strong></td>
                <td></td>
            </tr>
            <tr>
                <td>Pengirim: {{ $order->payment->name }}</td>
                <td></td>
            </tr>
            <tr>
                <td>Transfer ke: {{ $order->payment->transfer_to }}</td>
                <td></td>
            </tr>
            <tr>
                <td>Tanggal: {{ $order->payment->transfer_date  }}</td>
                <td></td>
            </tr>
            @endif -->
        </table>
    </div>
</body>


<style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: normal;
        /* inherit */
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }


    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td {
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }

    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
</style>

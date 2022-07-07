<div class="container">
    <div class="row mt-4 mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">History</li>
                </ol>
            </nav>
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

    <button onclick="myFunction()" class="btn btn-warning btn-block" style="color:black ">Riwayat Pembelian
    </button>

    <div id="history" action="">
        <div class="table-wrapper" style="width: 100%">
            <div class="md-card-content" style="overflow-x: auto;">

                <table class="table text-center">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Tanggal Pesan</td>
                            <td>Tanggal Diterima</td>
                            <td>Pesanan</td>
                            <td>Jumlah Pesanan</td>
                            <td>Status</td>
                            <td><strong>Total Harga</strong></td>
                            <td><strong>Lihat Nota</strong></td>


                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        @forelse ($pesanansukses as $pesanan)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $pesanan->tanggal_transaksi_cus }}</td>
                            <td>{{ $pesanan->updated_at }}</td>
                            <td>
                                <ul class="list-group">
                                    @foreach ($pesanan->custom_details as $detail)
                                        @if ($detail->kategory && $detail->materyal)
                                            <li class="list-group-item">
                                                {{$detail->kategory->nama_kategori}} <br />
                                                {{$detail->materyal->nama_material}} <br />
                                                {{ $detail->tebal }} x {{ $detail->lebar }} x {{ $detail->panjang }} mm
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>

                            </td>
                            <td>{{ $pesanan->custom_details()->sum('jumlah_pesanan_cus') }}</td>
                            <td>
                                @if($pesanan->status_cus == 5)
                                <h10>Pesanan Diterima</h10>
                                @endif
                            </td>
                            <td><strong>Rp. {{ number_format($pesanan->total_harga_cus) }}</strong></td>
                            <td> <a href="/notacustom/{{$pesanan->id}}" target="_blank" class="btn btn-dark mb-4"><i class="fas fa-eye"></i></a></td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">Data Kosong</td>
                        </tr>


                        @endforelse


                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <br>

    <!-- batas riwayat -->

    <h5> Pesanan Dalam Proses</h5><br>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Harap segera konfirmasi pesanan dengan klik tombol ✅ setelah produk diterima. <strong>Terima Kasih</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>


    <div class="row mt-4">
        <div class="col">
            <div class="table table-bordered">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Tanggal Pesan</td>
                            <td>Pesanan</td>
                            <td>Jumlah Pesanan</td>
                            <td>Status</td>
                            <td><strong>Total Harga</strong></td>
                            <td><strong>Lihat Nota</strong></td>
                            <td>Konfirmasi</td>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        @forelse ($pesanans as $pesanan)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $pesanan->tanggal_transaksi_cus }}</td>
                            <td>
                                <ul class="list-group">
                                    @foreach ($pesanan->custom_details as $detail)
                                        @if ($detail->kategory && $detail->materyal)
                                            <li class="list-group-item">
                                                {{$detail->kategory->nama_kategori}} <br />
                                                {{$detail->materyal->nama_material}} <br />
                                                {{ $detail->tebal }} x {{ $detail->lebar }} x {{ $detail->panjang }} mm
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>

                            </td>
                            <td>{{ $pesanan->custom_details()->sum('jumlah_pesanan_cus') }}</td>
                            <td>
                                @if($pesanan->status_cus == 2)
                                <h10>Produk telah diproses</h10>
                                @elseif($pesanan->status_cus == 3)
                                <h10>Produk telah dikirim</h10>
                                @else($pesanan->status_cus == 4)
                                <h10>Produk telah sampai ditempat tujuan</h10>
                                @endif
                            </td>
                            <td><strong>Rp. {{ number_format($pesanan->total_harga_cus) }}</strong></td>
                            <td> <a href="/notacustom/{{$pesanan->id}}" target="_blank" class="btn btn-dark mb-4"><i class="fas fa-eye"></i></a></td>

                            <td>
                                @if ($pesanan->status_cus >= 4)
                                <form wire:submit.prevent="submit({{ $pesanan->id }})">
                                    <button class="btn btn-success btn-sm "> <i class="fas fa-check"></i> </button>
                                </form>
                                @endif
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">Data Kosong</td>
                        </tr>


                        @endforelse


                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>

<script type="text/javascript">
    function myFunction() {
        var x = document.getElementById("history");

        if (x.style.display === "none") {
            $('#history').toggle(500);
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>

<style>
    #history {
        display: none;
        width: auto;
        border: 3px solid #ccc;
        padding: 20px;
        background: #ffffff;
    }
</style>

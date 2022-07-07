@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="section-header">
                <h1>Rekap Laporan</h1>
            </div>



            <form action="/rekapcus/date" method="POST">
                @csrf <br>
                <div class="ha">

                    <div class="form-group row">
                        <div class="col-md-6 form-group">
                            <label for="date" class="col-form-label">Mulai Tanggal</label>
                            <input type="date" class="form-control input-sm" id="fromDate" name="fromDate" required /><br>
                            <button type="submit" class="btn btn-info" name="search" title="search">Filter Berdasarkan
                                Tanggal</button>
                        </div>

                        <div class="col-md-6 form-group mt-md-0">
                            <label for="date" class="col-form-label">Hingga Tanggal</label>
                            <input type="date" class="form-control input-sm" id="toDate" name="toDate" required />

                        </div>



                    </div>

                </div>


            </form>



            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif


            <table id="myTable" class="table table-striped" style="width:100%">
                <thead class="table table-hover">
                    <tr>
                        <th width="80px" scope="col" style="text-align:center;">No. </th>
                        <th>Nama Perusahaan</th>
                        <th>Nama Customer</th>
                        <th>Jenis HH</th>
                        <th>Batang/PCS</th>
                        <th>Ukuran</th>
                        <th>Total Biaya</th>
                        <th>No Telp</th>
                        <th>Tujuan Pengangkutan</th>
                        <th>Lokasi</th>
                        <th>Alat Angkut</th>
                        <th>Keterangan</th>
                        <th>Tanggal Pesan</th>

                    </tr>
                </thead>

                <tbody>

                    @foreach($custom as $as)
                    <tr>
                        <th width="80px" scope="col" style="text-align:center;">{{$loop->iteration}}</th>
                        <td>{{ $as->nama_perusahaan}}</td>
                        <td>{{ $as->name}}</td>
                        @foreach ($as->custom_details as $produk)
                        <td>{{ str_replace(array('[','"',']'),'',$produk->kategory->nama_kategori)}}</td>
                        @endforeach
                        <td>{{ $as->jumlah_pesanan_cus}}</td>
                        <td>{{ $as->tebal}} x {{ $as->lebar}} x {{ $as->panjang}}</td>
                        <td>{{ $as->total_harga_cus}}</td>
                        <td>{{ $as->nohp}}</td>
                        <td>{{ $as->alamat}}</td>
                        <td>{{ $as->lokasi}}</td>
                        <td>{{ $as->alat_angkut_cus}}</td>
                        <td>{{ $as->ket_cus}}</td>
                        <td>{{ $as->tanggal_transaksi_cus}}</td>

                    </tr>
                    @endforeach

                </tbody>
            </table>


        </div>


    </div>

</div>

<style>
    .section .section-header h1 {
        color: white;
    }

    .section .section-header {        
        background-color:cadetblue;
        border-radius: 8px;
    }
</style>


<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            pageLength: 25,
            responsive: true,
            paging: true,
            scrollX: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [{
                    extend: 'copy'
                },
                {
                    extend: 'csv'
                },
                {
                    extend: 'excel',
                    title: 'ExampleFile'
                },
                {
                    extend: 'pdf',
                    title: 'ExampleFile'
                },

                {
                    extend: 'print',
                    customize: function(win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]
        });
    });
</script>

@endsection

@push('page-scripts')
@endpush
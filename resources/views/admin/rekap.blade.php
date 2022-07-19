@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="section-header">
                <h1>Rekap Laporan</h1>
            </div>



            <form action="{{ url()->current() }}" method="get">
                @csrf <br>
                <div class="ha">

                    <div class="form-group row">
                        <div class="col-md-6 form-group">
                            <label for="date" class="col-form-label">Mulai Tanggal</label>
                            <input type="date" class="form-control input-sm" id="fromDate" name="fromDate" value="{{ request('fromDate') }}" required /><br>
                            <a href="{{ url()->current() }}" class="btn btn-danger">Reset Filter</a>
                            <button type="submit" class="btn btn-info" name="search" title="search">Filter Berdasarkan
                                Tanggal</button>
                        </div>

                        <div class="col-md-6 form-group mt-md-0">
                            <label for="date" class="col-form-label">Hingga Tanggal</label>
                            <input type="date" class="form-control input-sm" id="toDate" name="toDate" value="{{ request('toDate') }}" required />

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
                        <th>No Telp</th>
                        <th>Tujuan Pengangkutan</th>
                        <th>Lokasi</th>
                        <th>Type</th>
                        <th>Jenis HH</th>
                        <th>Batang/PCS</th>
                        <th>Ukuran</th>
                        <th>Total Biaya</th>

                        <th>Alat Angkut</th>
                        <th>Keterangan</th>
                        <th>Tanggal Pesan</th>

                    </tr>
                </thead>

                <tbody>

                    @foreach($pesanan as $as)
                    <tr>
                        <th width="80px" scope="col" style="text-align:center;">{{$loop->iteration}}</th>
                        <td>{{ $as->user->nama_perusahaan}}</td>
                        <td>{{ $as->user->name}}</td>
                        <td>{{ $as->user->nohp}}</td>
                        <td>{{ $as->user->alamat}}</td>
                        <td>{{ $as->user->lokasi}}</td>
                        @if ($as instanceof \App\Pesanan)
                            @php
                                $details = $as->pesanan_details;
                                $totalUkuran = 0;
                                foreach ($details as $row) {
                                    $totalUkuran += $row->product->jml_ukuran;
                                }
                            @endphp
                            <th>Pesanan Biasa</th>
                            <td>
                                @foreach ($details as $rowDetail)
                                <h5 style="margin-bottom: 8px;padding: 5px;border: 1px solid rgb(189, 189, 189);">{{ $rowDetail->product->nama }}</h5>
                                @endforeach
                            </td>
                            <td>{{ $as->pesanan_details()->sum('jumlah_pesanan')}}</td>
                            <td>{{ $totalUkuran }}</td>
                            <td>{{ $as->total_harga}}</td>
                            <td>{{ $as->alat_angkut}}</td>
                            <td>{{ $as->ket}}</td>
                            <td>{{ $as->tanggal_transaksi}}</td>
                        @else
                            @php
                                $details = $as->custom_details;
                                $totalUkuran = 0;
                                foreach ($details as $row) {
                                    $totalUkuran += $row->jml_ukuran_cus;
                                }
                            @endphp
                            <th>Pesanan Custom</th>
                            <td>
                                @foreach ($details as $rowDetail)
                                <h5 style="margin-bottom: 8px;padding: 5px;border: 1px solid rgb(189, 189, 189);">
                                    {{ $rowDetail->kategory->nama_kategori }}
                                </h5>
                                @endforeach
                            </td>
                            <td>{{ $as->custom_details()->sum('jumlah_pesanan_cus')}}</td>
                            <td>{{ $totalUkuran}}</td>
                            <td>{{ $as->total_harga_cus}}</td>
                            <td>{{ $as->alat_angkut_cus}}</td>
                            <td>{{ $as->ket_cus}}</td>
                            <td>{{ $as->tanggal_transaksi_cus}}</td>
                        @endif

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

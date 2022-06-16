@extends('layouts.master')
@section('title', 'Laravel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class=" section-header">
                <h1>Daftar Menu</h1>
            </div>
            <p class="list1">Mendaftarkan menu </p>

            <a href="/menu/tambah" class="btn btn-info"> Tambah Menu</a>&nbsp;&nbsp; <a href="/menu/trash"
                class="btn btn-warning fas fa-trash"></a>
            &nbsp;&nbsp;
            <a href="/menu " class="btn btn-info fas fa-redo"></a><br> <br>
            <!-- style="background-color: #7962ea" -->

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Perhatian!</strong> Melakukan pengubahan dan penghapusan menu tidak bisa dilakukan jika menu
                sedang
                diakses!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>



        @if (session('status'))
        <div class="alert alert-info">
            {{ session('status') }}
        </div>
        @endif


        <table id="myTable" class="table table-striped" style="width:100%">
            <thead class="table table-hover">
                <tr>
                    <th width="80px" scope="col" style="text-align:center;">No.</th>
                    <th>Nama Menu</th>
                    <th>Level Menu</th>
                    <th>Master Menu</th>
                    <th>Url</th>
                    <th>Aktif</th>
                    <th>No. Urut</th>
                    <th>Aksi</th>

                </tr>
            </thead>

            <tbody>
                @if(!empty($menu) && $menu->count())
                @foreach($menu as $as)
                <tr>
                    <th width="80px" scope="col" style="text-align:center;">{{$loop->iteration + $skipped}}</th>
                    <td>{{ $as->nama_menu}}</td>
                    <td>{{ $as->level_menu}}</td>
                    <td>{{ $as->master_menu}}</td>
                    <td>{{ $as->url}}</td>
                    <td>{{ $as->aktif}}</td>
                    <td>{{ $as->no_urut}}</td>

                    <td>
                        <a class="fas fa-edit" href="/menu/edit/{{$as->id}}"></a>
                        &nbsp;&nbsp;
                        <a class="fas fa-trash" href="/menu/hapus/{{$as->id}}"
                            onclick="return confirm('Apakah anda yakin data ini akan dihapus?')"></a>
                    </td>

                </tr>
                @endforeach
                @endif


            </tbody>
            <table>
                {!! $menu->links() !!}
    </div>
</div>

</div>

<style>
#myTable_info {
    float: right;
}

#myTable_paginate {
    padding: 10px;
    float: right;
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
        }, {
            extend: 'csv'
        }, {
            extend: 'excel',
            title: 'ExampleFile'
        }, {
            extend: 'pdf',
            title: 'ExampleFile'
        }, {
            extend: 'print',
            customize: function(win) {
                $(win.document.body).addClass('white-bg');
                $(win.document.body).css('font-size', '10px');
                $(win.document.body).find('table').addClass('compact')
                    .css('font-size', 'inherit');
            }
        }]
    });
});
</script>

<script>
function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("myTable");
    switching = true;
    // Set the sorting direction to ascending:
    dir = "asc";
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
        // Start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /* Loop through all table rows (except the
        first, which contains table headers): */
        for (i = 1; i < (rows.length - 1); i++) {
            // Start by saying there should be no switching:
            shouldSwitch = false;
            /* Get the two elements you want to compare,
            one from current row and one from the next: */
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /* Check if the two rows should switch place,
            based on the direction, asc or desc: */
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            // Each time a switch is done, increase this count by 1:
            switchcount++;
        } else {
            /* If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again. */
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}
</script>

@endsection

@push('page-scripts')
@endpush
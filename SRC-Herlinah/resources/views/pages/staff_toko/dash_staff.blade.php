@extends('layout.staff_main')

@section('content')

<div class="content d-flex align-items-center flex-column">
    <h2 class="mb-4 mt-3"><strong>Daftar Transaksi Penjualan</strong></h2>
    <div class="transaction w-75">
        <div class="d-flex justify-content-between">
            <div id="reportrange" class="btn btn-secondary bg-light text-dark">
                <span></span>
            </div>
            <a href="/transaksi" class="btn btn-primary" id="tambahtransaksi" style="width: 150px;">Tambah Transaksi</a>
        </div>
        <span id="expenseSpan" class="printReport d-block mt-3 fs-4"></span>
        <span id="incomeSpan" class="printReport fs-4"></span>
        <table id="tableTransactionExpense" class="table display border border-dark cell-border" width="100%">
            <thead>
                <tr>
                    <th class="text-center" width="5%">ID Transaksi</th>
                    <th class="text-center" width="10%">Waktu</th>
                    <th class="text-center" width="20%">Total Harga</th>
                    <th class="text-center" width="20%">Total Bayar</th>
                    <th class="text-center" width="10%">Status Bayar</th>
                    <th class="text-center" width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $item)
                    <?php
                        $date = date_create($item->tanggal_penjualan)
                    ?>

                    <tr style="vertical-align: middle !important">
                        <td class="text-center">{{ $item->kode_transaksi }}</td>
                        <td class="text-center">{{ date_format($date,"d/m/Y") }}</td>
                        <td>{{ 'Rp. '. number_format($item->total, 2, ',', '.') }}</td>
                        <td align="{{ ($item->bayar > 0) ? 'left' : 'center'}}" width="25%">{{ ($item->bayar > 0) ? 'Rp. ' . number_format($item->bayar, 2, ',', '.') : '-' }}</h1></td>
                        <td align="center">
                            <span class="badge rounded-pill {{ ($item->status == 1) ? 'bg-success' : 'bg-danger' }}" style="padding: 5px 15px 5px 15px">{{ $item->statusnya }}</span>
                        </td>
                        <td align="center">
                            <span class="d-flex justify-content-center">
                                @if (($item->status == 1))
                                    <button class="btn btn-success" onclick="window.open('/printStruk/{{ $item->id_transaksi }}')" style="margin-right: 5px;">
                                        <i class="fa fa-print"></i>
                                    </button>
                                @else
                                    <a href="/transaksi/{{ $item->id_transaksi }}" class="btn btn-primary" style="margin-right: 5px;"><i class="fa fa-pen"></i></a>
                                    {{-- <form action="/deleteBarang/{{$item->id_transaksi}}" method="post" id="deleteBarang" class="ml-2"> --}}
                                        @csrf
                                        <button id="delete" data-id="{{$item->id_transaksi}}" type="button" data-bs-toggle="modal" data-bs-target="#KonfirmasiModalDeleteBarang" class="btn btn-danger">
                                            <span>
                                                <i class="fa fa-trash"></i>
                                            </span>
                                        </button>
                                    {{-- </form> --}}
                                @endif
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<!-- KONFIRMASI DELETE -->
<div class="modal fade" id="KonfirmasiModalDeleteBarang" tabindex="-1" role="dialog" aria-labelledby="KonfirmasiDeleteBarangModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="text-center mt-3">
                <h5 class="modal-title"><strong>Konfirmasi</strong></h5>
            </div>
            <div class="modal-body text-center">
                <p>Apakah Anda Ingin Menghapus ?</p>
            </div>
            <div class="text-center mt-3 mb-3 me-3">
                <button type="button" class="btn btn-primary" style="width: 100px;" data-bs-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-primary ms-3" style="width: 100px;" id="confirm-button" form="deleteBarang">Ya</button>
            </div>
        </div>
    </div>
</div>

<script>
    //fungsi untuk filtering data berdasarkan tanggal
    var start_date;
    var end_date;
    var DateFilterFunction = (function (oSettings, aData, iDataIndex) {
        var dateStart = parseDateValue(start_date);
        var dateEnd = parseDateValue(end_date);
        //Kolom tanggal yang akan kita gunakan berada dalam urutan 0
        var evalDate= parseDateValue(aData[1]);
        console.log('start >> '+dateStart+' end >> '+ dateEnd);


        if ( ( isNaN( dateStart ) && isNaN( dateEnd ) ) ||
                ( isNaN( dateStart ) && evalDate <= dateEnd ) ||
                ( dateStart <= evalDate && isNaN( dateEnd ) ) ||
                ( dateStart <= evalDate && evalDate <= dateEnd ) )
        {
            return true;
        }
        return false;
    });

    // fungsi untuk converting format tanggal dd/mm/yyyy menjadi format tanggal javascript menggunakan zona aktubrowser
    function parseDateValue(rawDate) {
        var dateArray= rawDate.split("/");
        var parsedDate= new Date(dateArray[2], parseInt(dateArray[1])-1, dateArray[0]);  // -1 because months are from 0 to 11
        return parsedDate;
    }

    $(document).ready(function() {
        var tableIncome = $("#tableTransactionIncome").DataTable();
        var tableExpense = $("#tableTransactionExpense").DataTable();

        var start = moment();
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'));
        }

        cb(start, end);

        $('#reportrange').daterangepicker({
            autoUpdateInput: false,
            startDate: start,
            endDate: end,
            autoclose: true,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        });

        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
            cb(picker.startDate, picker.endDate);
            start_date = picker.startDate.format('DD/MM/YYYY');
            end_date = picker.endDate.format('DD/MM/YYYY');

            $.fn.dataTableExt.afnFiltering.push(DateFilterFunction);
            tableExpense.draw();
        });

        $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
            cb(start, end);
            start_date='';
            end_date='';
            $.fn.dataTable.ext.search.splice($.fn.dataTable.ext.search.indexOf(DateFilterFunction, 1));
            tableExpense.draw();
        });

        $('tr td #delete').click(function(){
            var ID = $(this).data('id');
            $('#confirm-button').data('id', ID);
        });

        $('#confirm-button').click(function(){
            var ID = $(this).data('id');
            console.log(ID);

            window.location = "/transaksi/delete/" + ID;
        });
    });

</script>
@endsection

@extends('layout.pemilik_main')

@section('content')

<div class="content d-flex align-items-center flex-column">

    <!-- BERHASIL UPDATE BARANG -->
    @if(session('successEditBarang'))
    <div class="alert alert-success w-100 text-center" role="alert">
        <strong>
            {{session('successEditBarang')}}
        </strong>
    </div>
    @endif

    <!-- BERHASIL DELETE BARANG -->
    @if(session('successDeleteBarang'))
    <div class="alert alert-success w-100 text-center" role="alert">
        <strong>
            {{session('successDeleteBarang')}}
        </strong>
    </div>
    @endif

    <h2 class="mb-3 mt-5"><strong>Data Pembelian</strong></h2>
    <div class="transaction w-75">
        <div class="d-flex justify-content-between">
            <div id="reportrange" class="btn btn-secondary bg-light text-dark">
                <span></span>
            </div>
            {{-- <button class="btn btn-primary" id="print" style="width: 100px;" onclick=" window.open('/cetak','_blank')">Cetak</button> --}}
        </div>
        <span id="expenseSpan" class="printReport d-block mt-3 fs-4"></span>
        <span id="incomeSpan" class="printReport fs-4"></span>
        <table id="tableTransactionExpense" class="table display border border-dark cell-border" width='100%'>
            <thead>
                <tr>
                    <th class="text-center" width='15%'>Tanggal</th>
                    <th class="text-center" width='10%'>Kode Barang</th>
                    <th class="text-center" width='30%'>Nama Barang</th>
                    <th class="text-center" width='15%'>Harga Beli</th>
                    <th class="text-center" width='5%'>Jumlah</th>
                    <th class="text-center" width='15%'>Total</th>
                    <th class="text-center" width='5%'>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pembelians as $barang)
                <tr>
                    <td class="text-center">{{ date_format(date_create($barang->tanggal), 'd/m/Y') }}</td>
                    <td class="text-center">{{ $barang->kode_barang }}</td>
                    <td class="text-left">{{ $barang->nama_barang }}</td>
                    <td class="{{ (!empty($barang->harga_beli)) ? "text-left" : "text-center" }}">
                        {{
                            (!empty($barang->harga_beli))
                            ? "Rp. " . number_format($barang->harga_beli,2,',','.')
                            : "-"
                        }}
                    </td>
                    <td class="text-center">{{ $barang->jumlah_barang }}</td>
                    <td class="{{ (!empty($barang->total)) ? "text-left" : "text-center" }}">
                        {{
                            (!empty($barang->total))
                            ? "Rp. " . number_format($barang->total,2,',','.')
                            : "-"
                        }}
                    </td>
                    <td class="text-center">
                        <span class="d-flex justify-content-between">
                            <a href="/barangmasuk/{{$barang->id_pembelian}}" class="btn btn-success border-0">
                                <span>
                                    <i class="fa fa-pen"></i>
                                </span>
                            </a>
                            {{-- <form action="/deleteBarangMasuk/{{$barang->id_pembelian}}" method="post" id="deleteBarang"> --}}
                            {{-- @csrf --}}
                            <button id="delete" data-id="{{$barang->id_pembelian}}" type="button" class="btn btn-danger border-0" data-bs-toggle="modal" data-bs-target="#KonfirmasiModalDeleteBarang">
                                <span>
                                    <i class="fa fa-trash"></i>
                                </span>
                            </button>
                            {{-- </form> --}}
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
                <button type="submit" class="btn btn-primary ms-3" style="width: 100px;" id="confirm-button">Ya</button>
            </div>
        </div>
    </div>
</div>

<script>
    //fungsi untuk filtering data berdasarkan tanggal
    var start_date;
    var end_date;
    var DateFilterFunction = (function(oSettings, aData, iDataIndex) {
        var dateStart = parseDateValue(start_date);
        var dateEnd = parseDateValue(end_date);
        //Kolom tanggal yang akan kita gunakan berada dalam urutan 0
        var evalDate = parseDateValue(aData[0]);
        console.log('start >> ' + dateStart + ' end >> ' + dateEnd);


        if ((isNaN(dateStart) && isNaN(dateEnd)) ||
            (isNaN(dateStart) && evalDate <= dateEnd) ||
            (dateStart <= evalDate && isNaN(dateEnd)) ||
            (dateStart <= evalDate && evalDate <= dateEnd)) {
            return true;
        }
        return false;
    });

    // fungsi untuk converting format tanggal dd/mm/yyyy menjadi format tanggal javascript menggunakan zona aktubrowser
    function parseDateValue(rawDate) {
        var dateArray = rawDate.split("/");
        var parsedDate = new Date(dateArray[2], parseInt(dateArray[1]) - 1, dateArray[0]); // -1 because months are from 0 to 11
        return parsedDate;
    }

    $(document).ready(function() {
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
            start_date = '';
            end_date = '';
            $.fn.dataTable.ext.search.splice($.fn.dataTable.ext.search.indexOf(DateFilterFunction, 1));
            tableExpense.draw();
        });

        $('tr td #delete').click(function() {
            var ID = $(this).data('id');
            $('#confirm-button').data('id', ID);
        });

        $('#confirm-button').click(function() {
            var ID = $(this).data('id');
            console.log(ID);

            window.location = "/deleteBarangMasuk/" + ID;
        });
    });
</script>

@endsection
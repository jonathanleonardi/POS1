@extends('layout.pemilik_main')

@section('content')

<form action="/tambahBarangMasuk" method="post" id="tambahBarang">

    <!-- ALERT DI TAMBAH BARANG -->
    @if(session('failedAddBarang'))
    <div class="alert  alert-danger w-100 text-center" role="alert">
        {{session('failedAddBarang')}}
    </div>
    @endif

    @csrf
    <div class="container w-50">
        <div class="text-center mt-3">
            <h3><strong>Tambah Barang Masuk </strong></h3>
        </div>
        <div class="mt-4">
            <div class="form-group row">
                <label for="date" class="col-sm-3 col-form-label">Tanggal</label>
                <div class="col-sm-9">
                    <input type="text" data-provide="datepicker-inline" class="form-control" id="date" placeholder="Tanggal (YYYY-mm-dd)" name="tanggal" autocomplete="off" value='{{ date('Y-m-d'); }}' required>
                </div>
            </div>
            <div class="form-group row mt-3">
                <label for="inputIDBarang" class="col-sm-3 col-form-label">Kode Barang</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="inputIDBarang" placeholder="Kode Barang" min="1" onKeyPress="if(this.value.length==10) return false;" name="kode_barang" readonly required>
                    <input type="hidden" name="id">
                </div>
                <div class="col">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pilihBarang"><i class="fa fa-search"></i></button>
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="inputNamaBarang" class="col-sm-3 col-form-label">Nama Barang</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputNamaBarang" placeholder="Masukkan Nama Barang" maxlength="100" name="nama_barang" readonly required>
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="inputHargaBeli" class="col-sm-3 col-form-label">Harga Beli</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="inputHargaBeli" placeholder="Harga Beli" min="1" name="harga_beli" required>
                </div>
                <div class="col" style="margin: auto">
                    <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Harga per satuan barang"><i class="fa fa-info-circle"></i></a>
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="inputJumlah" class="col-sm-3 col-form-label">Jumlah Barang</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="inputJumlah" placeholder="jumlah" name="jumlah_barang" min="1" required>
                </div>
            </div>
        </div>
        <div class="text-end mt-3 mb-3">
            <a href="/dataBarang" type="button" class="btn btn-primary" style="width: 100px;" data-bs-dismiss="modal">Batal</a>
            <button type="button" class="btn btn-primary ms-3" style="width: 100px;" data-bs-toggle="modal" data-bs-target="#KonfirmasiModalTambahBarang">Simpan</button>
        </div>
    </div>

    <!-- DAFTAR BARANG -->
    <div class="modal fade" id="pilihBarang" tabindex="-1" role="dialog" aria-labelledby="KonfirmasiTambahBarangModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="text-center mt-3">
                    <h5 class="modal-title"><strong>Daftar Barang</strong></h5>
                </div>
                <div class="modal-body text-center">
                    <table id="tableTransactionExpense" class="table display border border-dark cell-border" width="100%">
                        <thead>
                            <tr>
                                <th style="display: none"></th>
                                <th class="text-center" width= "15%">Kode</th>
                                <th class="text-center" width= "40%">Nama Barang</th>
                                <th class="text-center" width= "15%">Stok</th>
                                <th class="text-center" width= "30%">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($barangs as $barang)
                            <tr>
                                <td style="display: none">{{$barang->id}}</td>
                                <td class="text-center" width= "15%">{{$barang->kode_barang}}</td>
                                <td align="left" width= "40%">{{$barang->nama_barang}}</td>
                                <td class="text-center" width= "15%">
                                    {{ ((!empty($barang->stok) > 0 ) ? $barang->stok : 0) }}
                                </td>
                                <td align="{{ (!empty($barang->harga_jual)) ? "left" : "center" }}" width= "30%">
                                    {{
                                        (!empty($barang->harga_jual))
                                        ? "Rp. " . number_format($barang->harga_jual,2,',','.')
                                        : "-"
                                    }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3 mb-3">
                    <button type="button" class="btn btn-primary" style="width: 100px;" data-bs-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- KONFIRMASI SIMPAN -->
    <div class="modal fade" id="KonfirmasiModalTambahBarang" tabindex="-1" role="dialog" aria-labelledby="KonfirmasiTambahBarangModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="text-center mt-3">
                    <h5 class="modal-title"><strong>Konfirmasi</strong></h5>
                </div>
                <div class="modal-body text-center">
                    <p>
                        Apakah Anda Yakin Ingin Menyimpan?
                    </p>
                </div>
                <div class="text-center mt-3 mb-3">
                    <button type="button" class="btn btn-primary" style="width: 100px;" data-bs-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-primary ms-3" style="width: 100px;" form="tambahBarang">Ya</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $((function() {
        var table = $('#tableTransactionExpense').DataTable();

         $('#date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
         });

        table.on('click','tr',function() {
            var data = table.row(this).data();
            console.log(data[0]);
            $("input[name='id']").val(data[0]);
            $("input[name='kode_barang']").val(data[1]);
            $("input[name='nama_barang']").val(data[2]);

            $('#pilihBarang').modal('toggle');
        });
    }));
</script>
@endsection

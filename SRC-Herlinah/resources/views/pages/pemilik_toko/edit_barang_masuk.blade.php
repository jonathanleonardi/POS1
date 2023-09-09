@extends('layout.pemilik_main')

@section('content')

<form action="/updateBarangMasuk" method="post" id="tambahBarang">

    <!-- ALERT DI TAMBAH BARANG -->
    @if(session('failedAddBarang'))
    <div class="alert  alert-danger w-100 text-center" role="alert">
        {{session('failedAddBarang')}}
    </div>
    @endif

    @csrf
    <div class="container w-50">
        <div class="text-center mt-3">
            <h3><strong>Update Barang Masuk </strong></h3>
        </div>
        <div class="mt-4">
            <div class="form-group row">
                <label for="date" class="col-sm-3 col-form-label">Tanggal</label>
                <div class="col-sm-9">
                    <input type="text" data-provide="datepicker-inline" class="form-control" id="date" placeholder="Tanggal (YYYY-mm-dd)" name="tanggal" autocomplete="off"  value="{{ date_format(date_create($pembelian->tanggal), 'Y-m-d'); }}" readonly required>
                    <input type="hidden" name="id_pembelian" value="{{ $pembelian->id_pembelian }}">
                </div>
            </div>
            <div class="form-group row mt-3">
                <label for="inputIDBarang" class="col-sm-3 col-form-label">Kode Barang</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputIDBarang" placeholder="Kode Barang" min="1" onKeyPress="if(this.value.length==10) return false;" name="kode_barang" value="{{ $pembelian->kode_barang }}" readonly required>
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="inputNamaBarang" class="col-sm-3 col-form-label">Nama Barang</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputNamaBarang" placeholder="Masukkan Nama Barang" maxlength="100" name="nama_barang" value="{{ $pembelian->nama_barang }}" readonly required>
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="inputHargaBeli" class="col-sm-3 col-form-label">Harga Beli</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="inputHargaBeli" placeholder="Harga Beli" min="1" name="harga_beli" value="{{ $pembelian->harga_beli }}"required>
                </div>
                <div class="col" style="margin: auto">
                    <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Harga per satuan barang"><i class="fa fa-info-circle"></i></a>
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="inputJumlah" class="col-sm-3 col-form-label">Jumlah Barang</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="inputJumlah" placeholder="jumlah" name="jumlah_barang" value="{{ $pembelian->jumlah_barang }}" required>
                </div>
            </div>
        </div>
        <div class="text-end mt-3 mb-3">
            <a href="/viewReportPembelian" type="button" class="btn btn-primary" style="width: 100px;" data-bs-dismiss="modal">Batal</a>
            <button type="button" class="btn btn-primary ms-3" style="width: 100px;" data-bs-toggle="modal" data-bs-target="#KonfirmasiModalTambahBarang">Simpan</button>
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
</script>
@endsection

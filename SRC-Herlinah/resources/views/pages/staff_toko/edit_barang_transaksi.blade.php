@extends('layout.staff_main')

@section('content')

<form action="/editBarangTransaksi" method="post" id="editBarangTransaksi">
    @csrf
    <div class="container w-50">
        <div class="text-center mt-3">
            <h5 class="modal-title"><strong>Edit Barang</strong></h5>
        </div>
        <div class="modal-body">
            <div class="form-group row mt-2">
                <label for="EditNamaBarangTransaksi" class="col-sm-3 col-form-label">Nama Barang</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" list="namaBarang" id="EditNamaBarangTransaksi" maxlength="100" value="{{$barang->nama_barang}}" name="namaBarang" required>
                    <datalist id="namaBarang">
                        @foreach($barangs as $detail)
                        <option value="{{$detail->nama_barang}}">
                            @endforeach
                    </datalist>
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="EditStokBarangTransaksi" class="col-sm-3 col-form-label">Jumlah</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="inputStokBarang" min="1" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==3) return false;" value="{{$barang->jumlah_barang}}" name="stokBarang" required>
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="EditHargaBarangTransaksi" class="col-sm-3 col-form-label">Harga</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="inputHarga" min="1" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==9) return false;" value="{{$barang->harga_jual}}" name="hargaJual" required>
                </div>
            </div>
        </div>
        <div class="text-end mt-2 mb-2 me-3">
            <a href="/transaksi" type="button" class="btn btn-primary" style="width: 100px;" data-bs-dismiss="modal">Batal</a>
            <button type="button" class="btn btn-primary" style="width: 100px;" data-bs-toggle="modal" data-bs-target="#KonfirmasiModalEditBarangTransaksi" form="editBarangTransaksi">Simpan</button>
        </div>
    </div>

    <!-- KONFIRMASI SIMPAN -->
    <div class="modal fade" id="KonfirmasiModalEditBarangTransaksi" tabindex="-1" role="dialog" aria-labelledby="KonfirmasiEditBarangTransaksiModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="text-center mt-3">
                    <h5 class="modal-title"><strong>Konfirmasi</strong></h5>
                </div>
                <div class="modal-body text-center">
                    <p>
                        Apakah Anda Yakin Ingin Menyimpan Perubahan Ini?
                    </p>
                </div>
                <div class="text-center mt-3 mb-3 me-3">
                    <button type="button" class="btn btn-primary" style="width: 100px;" data-bs-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-primary ms-3" style="width: 100px;" form="editBarangTransaksi">Ya</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@extends('layout.pemilik_main')

@section('content')

<form action="/editBarang" method="post" id="editBarang">
    @csrf
    <div class="container w-50">
        <div class="text-center mt-3">
            <h5 class="modal-title"><strong>Edit Barang</strong></h5>
        </div>
        <div class="modal-body">
            <div class="form-group row">
                <label for="inputIDBarang" class="col-sm-3 col-form-label">Kode Barang</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputIDBarang" value="{{$barang->kode_barang}}" name="kode_barang" readonly required>
                    <input type="hidden" name="id_barang" value="{{$barang->id}}">
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="inputNamaBarang" class="col-sm-3 col-form-label">Nama Barang</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputNamaBarang" maxlength="100" value="{{$barang->nama_barang}}" name="namaBarang" required>
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="inputStokBarang" class="col-sm-3 col-form-label">Stok Barang</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="inputStokBarang" value="{{$barang->stok}}" name="stokBarang" readonly required>
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="inputHargaBeli" class="col-sm-3 col-form-label">Harga Beli</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="inputHargaBeli"  value="{{$barang->harga_beli}}" name="hargaBeli" readonly required>
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="inputKeuntungan" class="col-sm-3 col-form-label">Keuntungan</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="inputKeuntungan"  value="{{$barang->keuntungan}}" name="keuntungan" required>
                </div>
                <div class="col" style="margin: auto">
                    <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Untuk menentukan harga jual berdasarkan harga beli"><i class="fa fa-info-circle"></i></a>
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="inputHargaJual" class="col-sm-3 col-form-label">Harga Jual</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="inputHargaJual" value="{{$barang->harga_jual}}" name="hargaJual" readonly required>
                </div>
            </div>
            {{-- <div class="form-group row mt-2">
                <label for="inputSatuan" class="col-sm-3 col-form-label">Satuan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputSatuan" value="{{$barang->satuan}}" name="satuan" required>
                </div>
            </div> --}}
        </div>
        <div class="text-end mt-3 mb-3 me-3">
            <a href="/dataBarang" type="button" class="btn btn-primary" style="width: 100px;" data-bs-dismiss="modal">Batal</a>
            <button type="button" class="btn btn-primary" style="width: 100px;" data-bs-toggle="modal" data-bs-target="#KonfirmasiModalEditStaff" form="editBarang">Simpan</button>
        </div>

        <!-- KONFIRMASI SIMPAN -->
        <div class="modal fade" id="KonfirmasiModalEditStaff" tabindex="-1" role="dialog" aria-labelledby="KonfirmasiEditStaffModalTitle" aria-hidden="true">
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
                        <button type="submit" class="btn btn-primary ms-3" style="width: 100px;" form="editBarang">Ya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(function(){
        $("input[name='keuntungan']").change(function(e){
            var hargaBeli = $("input[name='hargaBeli']").val(),
                keuntungan = $(this).val(),
                hargaJual = parseInt(hargaBeli) + parseInt(keuntungan);

            console.log(hargaJual);
            $("input[name='hargaJual']").val(hargaJual);
        });
    });
</script>
@endsection

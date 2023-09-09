@extends('layout.pemilik_main')

@section('content')

<div class="content d-flex align-items-center flex-column">

    <!-- BERHASIL TAMBAH BARANG -->
    @if(session('successAddBarang'))
    <div class="alert alert-success w-100 text-center" role="alert">
        <strong>
            {{session('successAddBarang')}}
        </strong>
    </div>
    @endif

    <!-- BERHASIL EDIT BARANG -->
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

    <h2 class="mb-4 mt-3"><strong>Data Barang</strong></h2>
    <div class="transaction w-75">
        <div class="justify-content-center mb-5">
            <a href="/tambahBarang" class="btn btn-primary" style="width: 175px;"><span><i class="fa fa-plus"></i> Tambah Barang</span></a>
            <a href="/tambahBarangMasuk" class="btn btn-primary" style="width: 175px;"><span><i class="fa fa-plus"></i> Barang Masuk</span></a>
            <!-- <a href="/tambahStokBarang" class="btn btn-primary ms-3" style="width: 175px;">Tambah Stok Barang</a> -->
        </div>
        {{-- <span id="expenseSpan" class="printReport d-block mt-3 fs-4"></span>
        <span id="incomeSpan" class="printReport fs-4"></span> --}}
        <table id="tableTransactionExpense" class="table display border border-dark cell-border">
            <thead>
                <tr>
                    <th class="text-center" style="width: 75px;">Kode</th>
                    <th class="text-center">Nama Barang</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center">Harga Beli</th>
                    <th class="text-center">Harga Jual</th>
                    <th class="text-center" style="width: 75px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangs as $barang)
                <tr>
                    <td class="text-center">{{$barang->kode_barang}}</td>
                    <td>{{$barang->nama_barang}}</td>
                    <td class="text-center">
                        {{ $barang->stok 
                            ? " " . number_format($barang->stok,0,',','.')
                            : '-'
                        }}
                    </td>
                    <td class="{{ (!empty($barang->harga_beli)) ? "text-left" : "text-center" }}">
                        {{
                            (!empty($barang->harga_beli))
                            ? "Rp. " . number_format($barang->harga_beli,2,',','.')
                            : "-"
                        }}
                    </td>
                    <td class="{{ (!empty($barang->harga_jual)) ? "text-left" : "text-center" }}">
                        {{
                            (!empty($barang->harga_jual))
                            ? "Rp. " . number_format($barang->harga_jual,2,',','.')
                            : "-"
                        }}
                    </td>
                    <td class="text-center">
                        <span class="d-flex justify-content-between">
                            <a href="/editBarang/{{$barang->id}}" class="btn btn-success border-0">
                                <span>
                                    <i class="fa fa-pen"></i>
                                </span>
                            </a>
                            {{-- <form action="/deleteBarang/{{$barang->id}}" method="post" id="deleteBarang"> --}}
                            {{-- @csrf --}}
                            <button id="delete" data-id="{{$barang->id}}" type="button" data-bs-toggle="modal" data-bs-target="#KonfirmasiModalDeleteBarang" class="btn btn-danger border-0">
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
</div>
<script>
    $(document).ready(function() {
        $('tr td #delete').click(function() {
            var ID = $(this).data('id');
            $('#confirm-button').data('id', ID);
        });

        $('#confirm-button').click(function() {
            var ID = $(this).data('id');
            console.log(ID);

            window.location = "/deleteBarang/" + ID;
        });
    });
</script>

@endsection
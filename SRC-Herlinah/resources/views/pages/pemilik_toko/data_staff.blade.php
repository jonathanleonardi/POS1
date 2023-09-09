@extends('layout.pemilik_main')

@section('content')

<div class="content d-flex align-items-center flex-column">

    <!-- BERHASIL TAMBAH STAFF TOKO -->
    @if(session('successAddStaff'))
    <div class="alert alert-success w-100 text-center" role="alert">
        <strong>
            {{session('successAddStaff')}}
        </strong>
    </div>
    @endif

    <!-- BERHASIL EDIT STAFF TOKO -->
    @if(session('successEditStaff'))
    <div class="alert alert-success w-100 text-center" role="alert">
        <strong>
            {{session('successEditStaff')}}
        </strong>
    </div>
    @endif

    <!-- BERHASIL DELETE STAFF TOKO -->
    @if(session('successDeleteStaff'))
    <div class="alert alert-success w-100 text-center" role="alert">
        <strong>
            {{session('successDeleteStaff')}}
        </strong>
    </div>
    @endif

    <h2 class="mb-4 mt-3"><strong>Data Staff Toko</strong></h2>
    <div class="transaction w-75">
        <a href="/tambahStaff" class="btn btn-primary" style="width: 175px;">Tambah Staff</a>
        <span id="expenseSpan" class="printReport d-block mt-3 fs-4"></span>
        <span id="incomeSpan" class="printReport fs-4"></span>
        <table id="tableTransactionExpense" class="table display border border-dark cell-border">
            <thead>
                <tr>
                    <th class="text-center" style="width: 150px;">Kode Staff</th>
                    <th class="text-center">Nama Staff</th>
                    <th class="text-center">Email Staff</th>
                    <th class="text-center" style="width: 75px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach($staffs as $staff)
                    <td>{{$staff->kode_user}}</td>
                    <td>{{$staff->nama}}</td>
                    <td>{{$staff->email}}</td>
                    <td class="text-center">
                        <span class="d-flex justify-content-between">
                            <a href="/editStaff/{{$staff->id_user}}" class="btn btn-success border-0">
                                <span>
                                    <i class="fa fa-pen"></i>
                                </span>
                            </a>
                            <form action="/deleteStaff/{{$staff->id_user}}" method="post" id="deleteStaffForm">
                                @csrf
                                <button type="button" data-bs-toggle="modal" data-bs-target="#KonfirmasiModalDeleteStaff" class="btn btn-danger border-0">
                                    <span>
                                        <i class="fa fa-trash"></i>
                                    </span>
                                </button>
                            </form>
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- KONFIRMASI DELETE -->
    <div class="modal fade" id="KonfirmasiModalDeleteStaff" tabindex="-1" role="dialog" aria-labelledby="KonfirmasiModalDeleteStaffModalTitle" aria-hidden="true">
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
                    <button type="submit" class="btn btn-primary ms-3" style="width: 100px;" form="deleteStaffForm">Ya</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

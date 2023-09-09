@extends('layout.pemilik_main')

@section('content')

    @csrf
    <div class="container mt-5">
        <div class="row justify-content-center mb-5">
            <div class="col-4">
                <div class="text-center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Staff Toko</h5>
                            <p class="card-text fs-1">{{$staffs}}</p>
                            <a href="/dataStaff" class="btn btn-primary">Data Staff</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="text-center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Barang</h5>
                            <p class="card-text fs-1">{{$barangs}}</p>
                            <a href="/dataBarang" class="btn btn-primary">Data Barang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-2">
                <a href="/viewReportPembelian" class="btn btn-primary">Data Pembelian</a>
            </div>
            <div class="col-2">
                <a href="/viewReport" class="btn btn-primary">Data Penjualan</a>
            </div>
        </div>
    </div>

@endsection

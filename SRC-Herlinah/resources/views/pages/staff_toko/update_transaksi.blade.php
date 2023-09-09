@extends('layout.staff_main')

@section('content')

@csrf
<div class="container-fluid">
    <div class="row justify-content-center mb-5">
        <div class="col-lg-3">
            <div class="card p-3">
                <div class="form-group row">
                    <label for="date" class="col-sm-3 col-form-label">Tanggal</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="date" name="tanggal" value="{{ $transaksi->tanggal_penjualan }}" autocomplete="off" readonly>
                    </div>
                </div>
                <div class="form-group row pt-3">
                    <label for="date" class="col-sm-3 col-form-label">Kasir</label>
                    <div class="col">
                        <input type="text" class="form-control" name="kasir" value="{{ $transaksi->nama }}" readonly>
                        <input type="hidden" id="idUser" name="id_user" value="{{ $transaksi->id_user }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card p-3">
                <div class="form-group row">
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="barang" placeholder='Pilih Barang' value="" readonly>
                    </div>
                    <div class="col-2">
                        <button type="button" id="search" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pilihBarang"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <div class="form-group row pt-3">
                    <div class="col-sm-2">
                        <input type="number" class="form-control" id="jumlah" value='' placeholder='Jumlah'>
                    </div>
                    <div class="col-2">
                        <button type="button" id="addCart" class="btn btn-primary"><i class="fa fa-sharp fa-solid fa-plus-circle"></i> Tambah</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-3" style="margin: auto">
                <div style="text-align: right !important">
                    <h5>#Invoice <strong id="invoice">{{ $invoice }}</strong></h5>
                    <h1><strong id="totalBayar">{{ 'Rp. '.number_format($transaksi->total, 0, ',', '.') }}</strong></h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <table id="cartTable" class="table table-bordered border-primary" width='100%'>
        <thead>
            <tr>
                <th class="text-center" width="5%">#</th>
                <th class="text-center" width="5%">Kode</th>
                <th class="text-left" width="35%">Nama Barang</th>
                <th class="text-center" width="10%">Jumlah</th>
                <th class="text-center" width="20%">Harga</th>
                <th class="text-center" width="20%">Total</th>
                <th class="text-center" width="5%">#</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<div class="container-fluid pt-3">
    <div class="row justify-content-end">
        <div class="col-lg-1">
            <div class="form-group">
                <select name="jenis_bayar" id="jenisBayar" class="form-control">
                    <option value="" hidden>Pembayaran</option>
                    <option value="1">Tunai</option>
                    <option value="0" {{ ($transaksi->status == 0) ? 'selected' : '' }}>Tunda</option>
                </select>
            </div>
        </div>
        <div class="col-lg-2 text-end">
            <input type="number" class="form-control" name="bayar" id="bayar" value="0" readonly>
        </div>
    </div>
</div>

<div class="container-fluid mt-5">
    <div class="row justify-content-between">
        <div class="col">
            <a href="{{ (session('user')->role_id == 0) ? 'pemilikToko' : '/staffToko' }}" class="btn btn-default btn-outline-secondary">Kembali</a>
        </div>
        <div class="col">
            <div class="col text-end">
                <button type="button" class="btn btn-primary" id="save"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-success" id="print"><i class="fa fa-print"></i> Cetak</button>
            </div>
        </div>
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
                            <th class="text-center" width="15%">Kode</th>
                            <th class="text-center" width="40%">Nama Barang</th>
                            <th class="text-center" width="15%">Stok</th>
                            <th class="text-center" width="30%">Harga</th>
                            <th style="display: none">Harga beli</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($barangs as $barang)
                        <tr>
                            <td style="display: none">{{$barang->id}}</td>
                            <td class="text-center" width="15%">{{$barang->kode_barang}}</td>
                            <td align="left" width="40%">{{$barang->nama_barang}}</td>
                            <td class="text-center" width="15%">
                                {{
                                        ((!empty($barang->stok) > 0 ) ? $barang->stok : 0)
                                    }}
                            </td>
                            <td align="{{ (!empty($barang->harga_jual)) ? "left" : "center" }}" width="30%">
                                {{
                                        (!empty($barang->harga_jual))
                                        ? $barang->harga_jual
                                        : "-"
                                    }}
                            </td>
                            <td style="display: none">
                                {{
                                        (!empty($barang->harga_beli))
                                        ? $barang->harga_beli
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

<script>
    var _tempBarang = {},
        _cart = <?php echo json_encode($penjualan); ?>,
        _item = [],
        _totalBayar = 0;

    $((function() {
        var table = $('#tableTransactionExpense').DataTable();

        if (_cart) {
            console.log(_cart);

            $.each(_cart, function(i) {
                _item.push({
                    'id_penjualan': _cart[i].id_penjualan,
                    'id_transaksi': _cart[i].id_transaksi,
                    'id_barang': _cart[i].id_barang,
                    'tanggal_penjualan': _cart[i].tanggal_penjualan,
                    'jumlah_barang': _cart[i].jumlah_barang,
                    'harga_jual': _cart[i].harga_jual,
                    'harga_beli': _cart[i].harga_beli,
                    'total': _cart[i].total,
                });
            });

            updateCart();
        }

        $('#barang').on('click', function() {
            $('#pilihBarang').modal('toggle');
        });

        table.on('click', 'tr', function() {
            clearData();
            var data = table.row(this).data();

            _tempBarang = {
                'id': data[0],
                'kode_barang': data[1],
                'nama_barang': data[2],
                'stok': parseInt(data[3]),
                'harga_jual': parseInt(data[4]),
                'harga_beli': parseInt(data[5])
            };

            $('#barang').val(data[1] + ' - ' + data[2]);

            $('#pilihBarang').modal('toggle');
        });

        $('#addCart').on('click', function() {
            if ($('#barang').val() == '') {
                alert('Pilih barang terlebih dahulu');
            } else if ($('#jumlah').val() == '') {
                alert('Isi stok terlebih dahulu');
            } else if ($('#barang').val() != '' && ($('#jumlah').val() != '' || $('#jumlah').val() != 0)) {
                addToCart();
            }

            console.log($('#barang').val());
        });

        $('#save').on('click', function() {
            var data;

            if ($('#jenisBayar').val() == '') {
                alert('Pilih status pembayaran')
            } else if ($('#bayar').val() < _totalBayar && $('#jenisBayar').val() == 1) {
                alert('Pembayaran kurang')
            } else if (_cart.length <= 0) {
                alert('Tidak ada barang yang dipilih')
            } else {
                data = {
                    'id_transaksi': {
                        {
                            $transaksi - > id_transaksi
                        }
                    },
                    'kode_transaksi': $('#invoice').text(),
                    'tanggal_penjualan': $('#date').val(),
                    'status': $('#jenisBayar').val(),
                    'total': _totalBayar,
                    'bayar': $('#bayar').val(),
                    'id_user': $('#idUser').val(),
                };

                if (_cart.length > 0) {
                    $.ajax({
                        url: "/transaksi/update",
                        type: "post",
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            data: {
                                'transaksi': data,
                                'item': _item,
                            },
                        },
                        success: function(data) {
                            console.log(data);
                            if (data.success) {
                                $('#print').attr('onclick', 'window.open("/printStruk/' + data.id_transaksi + '")');
                                $('#save').prop('disabled', true);
                                $('#barang').prop('disabled', true);
                                $('#search').prop('disabled', true);

                                Swal.fire(
                                    'Selamat!',
                                    'Transaksi berhasil diupdate',
                                    'success'
                                );
                            }
                        }
                    });
                } else {
                    alert('Tidak ada barang untuk diinput');
                }
            }
        });

        $('#jenisBayar').change(function() {
            var $option = $(this).find('option:selected');
            //Add with EDIT
            var value = $option.val();
            console.log(value);
            if (value == 1) {
                $('#bayar').removeAttr('readonly');
            } else {
                $('#bayar').attr('readonly', true);
            }
        });
    }));

    /* Add to cart */
    function addToCart() {
        var _isExist = searchBarang(_tempBarang.id);
        console.log('cart ke ' + _isExist + ' length ' + _cart.length);

        if (_isExist.toString() != '') {
            var _tempStok = parseInt(_tempBarang.stok),
                _currStok = parseInt($('#jumlah').val()) + parseInt(_cart[_isExist].jumlah_barang);
            if (_currStok > _tempStok) {
                alert('Melebihi batas stok');
                clearData();
            } else {
                _cart[_isExist].jumlah_barang = _currStok;
                _cart[_isExist].total = _cart[_isExist].jumlah_barang * parseInt(_cart[_isExist].harga_jual);

                _item[_isExist].jumlah_barang = _currStok;
                _item[_isExist].total = _cart[_isExist].jumlah_barang * parseInt(_cart[_isExist].harga_jual);

                updateCart();
            }
        } else {
            if (parseInt($('#jumlah').val()) > parseInt(_tempBarang.stok)) {
                alert('Melebihi batas stok');
            } else {
                var _jumlah = parseInt($('#jumlah').val()),
                    _hargaJual = parseInt(_tempBarang.harga_jual),
                    _total = _jumlah * _hargaJual;

                _cart.push({
                    'id_transaksi': null,
                    'kode_barang': _tempBarang.kode_barang,
                    'id_barang': _tempBarang.id,
                    'nama_barang': _tempBarang.nama_barang,
                    'jumlah_barang': parseInt($('#jumlah').val()),
                    'harga_jual': parseInt(_tempBarang.harga_jual),
                    'harga_beli': parseInt(_tempBarang.harga_beli),
                    'total': parseInt($('#jumlah').val()) * parseInt(_tempBarang.harga_jual),
                });

                _item.push({
                    'id_penjualan': null,
                    'id_transaksi': parseInt({
                        {
                            $transaksi - > id_transaksi
                        }
                    }),
                    'id_barang': parseInt(_tempBarang.id),
                    'tanggal_penjualan': $('#date').val(),
                    'jumlah_barang': parseInt($('#jumlah').val()),
                    'harga_jual': parseInt(_tempBarang.harga_jual),
                    'harga_beli': parseInt(_tempBarang.harga_beli),
                    'total': parseInt($('#jumlah').val()) * parseInt(_tempBarang.harga_jual),
                });

                updateCart();
            }
        }
    }

    function searchBarang(nameKey) {
        if (_cart.length > 0) {
            for (let i = 0; i < _cart.length; i++) {
                if (_cart[i].id_barang == nameKey) {
                    return i;
                }
            }
        }
        return '';
    }

    function updateCart() {
        var _html = '';

        _totalBayar = 0;

        $('#cartTable tbody').html(_html);

        $.each(_cart, function(i) {
            _html += '<tr>' +
                '<td class="text-center">' + (i + 1) + '</td>' +
                '<td class="text-center">' + _cart[i].kode_barang + '</td>' +
                '<td>' + _cart[i].nama_barang + '</td>' +
                '<td class="text-center">' + _cart[i].jumlah_barang + '</td>' +
                '<td>' + formatRupiah(parseInt(_cart[i].harga_jual)) + '</td>' +
                '<td>' + formatRupiah(_cart[i].jumlah_barang * parseInt(_cart[i].harga_jual)) + '</td>' +
                '<td class="text-center"><button type="button" class="btn btn-danger" onclick="deleteCart(this, ' + _cart[i].id_penjualan + ',' + i + ')"><i class="fa fa-trash"></i></button></td>' +
                '</tr>';
            _totalBayar += _cart[i].jumlah_barang * parseInt(_cart[i].harga_jual);
        });
        $('#cartTable tbody').append(_html);
        $('#totalBayar').text(formatRupiah(parseInt(_totalBayar)));

        clearData();
    }

    function deleteCart($this, idPenjualan = 0, index = 0) {
        $.ajax({
            url: "/penjualan/delete",
            type: "post",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'id_penjualan': idPenjualan
            },
            success: function(data) {
                console.log(data);

                _cart.splice(index, 1);
                _item.splice(index, 1);

                $($this).parent().closest("tr").remove();

                updateCart();
            }
        });
    }

    /* Fungsi formatRupiah */
    function formatRupiah(angka) {
        var number_string = angka.toString(),
            sisa = number_string.length % 3,
            rupiah = number_string.substr(0, sisa),
            ribuan = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        return 'Rp. ' + rupiah + ',00';
    }

    function clearData() {
        _tempBarang = {};
        $('#barang').val('');
        $('#jumlah').val('');
    }
</script>
@endsection
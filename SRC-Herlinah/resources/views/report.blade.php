@php
    $no = 1
@endphp
<table>
    <tr>
        <th colspan="7" align="center">SRC Herlinah</th>
    </tr>
    <tr>
        <th colspan="7" align="center">Jl. CIMANUK NO.145 GARUT</th>
    </tr>
    <tr></tr>
    <tr>
        <th align="center" style="border: 1px solid black; border-collapse: collapse; height: 30px; vertical-align: middle;"><b>No</b></th>
        <th colspan="2" align="center" style="border: 1px solid black; border-collapse: collapse; height: 30px; vertical-align: middle;"><b>ID Transaksi</b></th>
        <th colspan="3" align="center" style="border: 1px solid black; border-collapse: collapse; height: 30px; vertical-align: middle;"><b>Waktu</b></th>
        <th align="center" style="border: 1px solid black; border-collapse: collapse; height: 30px; vertical-align: middle;"><b>Total</b></th>
    </tr>
    @if (count($report) == 0)
        <tr>
            <td align="center" style="border: 1px solid black; border-collapse: collapse; font-style: italic" colspan="7">Tidak ada data untuk ditampilkan</td>
        </tr>
    @else
        @foreach($report as $reportList)
            @php
                $itemCount = count($reportList['item']);
            @endphp
            <tr>
                <td align="center" style="border: 1px solid black; border-collapse: collapse;">{{ $no++ }}</td>
                <td colspan="2" align="left" style="border: 1px solid black; border-collapse: collapse;">{{ strval($reportList['transaksi']->kode_transaksi) }}</td>
                <td colspan="3" align="left" style="border: 1px solid black; border-collapse: collapse;">{{ $reportList['transaksi']->tanggal_penjualan }}</td>
                <td align="right" style="border: 1px solid black; border-collapse: collapse;">{{ 'Rp. '. number_format($reportList['transaksi']->total, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td align="right" style="border: 1px solid black; border-collapse: collapse;"></td>
                <td align="center" style="border: 1px solid black; border-collapse: collapse;">Nama Barang</td>
                <td align="center" style="border: 1px solid black; border-collapse: collapse;">Jumlah Barang</td>
                <td align="center" style="border: 1px solid black; border-collapse: collapse;">Harga Beli</td>
                <td align="center" style="border: 1px solid black; border-collapse: collapse;">Harga Jual</td>
                <td align="center" style="border: 1px solid black; border-collapse: collapse;">Sub Total</td>
                <td align="right" style="border: 1px solid black; border-collapse: collapse;"></td>
            </tr>
            @foreach ($reportList['item'] as $barang)
                <tr>
                    <td align="right" style="border: 1px solid black; border-collapse: collapse;"></td>
                    <td align="left" style="border: 1px solid black; border-collapse: collapse;">{{ $barang->nama_barang }}</td>
                    <td align="center" style="border: 1px solid black; border-collapse: collapse;">{{$barang->jumlah_barang}}</td>
                    <td align="right" style="border: 1px solid black; border-collapse: collapse;">{{ 'Rp. '. number_format($barang->harga_beli, 2, ',', '.') }}</td>
                    <td align="right" style="border: 1px solid black; border-collapse: collapse;">{{ 'Rp. '. number_format($barang->harga_jual, 2, ',', '.') }}</td>
                    <td align="right" style="border: 1px solid black; border-collapse: collapse;">{{ 'Rp. '. number_format($barang->total, 2, ',', '.') }}</td>
                    <td align="right" style="border: 1px solid black; border-collapse: collapse;"></td>
                </tr>
            @endforeach
        @endforeach
    @endif
</table>

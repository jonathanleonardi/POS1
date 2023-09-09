<html>
    <head>
        <title>Cetak Nota {{ $transaksi->kode_transaksi }}</title>
        <style>
            @page { margin: 0 }
            body { margin: 0; font-size:10px;font-family: monospace;}
            td { font-size:10px; }
            .sheet {
            margin: 0;
            overflow: hidden;
            position: relative;
            box-sizing: border-box;
            page-break-after: always;
            }

            /** Paper sizes **/
            body.struk        .sheet { width: 58mm; }
            body.struk .sheet        { padding: 2mm; }

            .txt-left { text-align: left;}
            .txt-center { text-align: center;}
            .txt-right { text-align: right;}

            /** For screen preview **/
            @media screen {
                body { background: #e0e0e0;font-family: monospace; }
                .sheet {
                    background: white;
                    box-shadow: 0 .5mm 2mm rgba(0,0,0,.3);
                    margin: 5mm;
                }
            }

            /** Fix for Chrome issue #273306 **/
            @media print {
                body { font-family: monospace; }
                body.struk                 { width: 58mm; text-align: left;}
                body.struk .sheet          { padding: 2mm; }
                .txt-left { text-align: left;}
                .txt-center { text-align: center;}
                .txt-right { text-align: right;}
            }
        </style>
    </head>
    <body class="struk" onload="printOut()">
        <section class="sheet">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td align="center" colspan="3"><h1 style="margin-bottom: 0"><b>SRC HERLINAH</b></h1></td>
                </tr>
                <tr>
                    <td align="center" colspan="3" style="padding-bottom: 2mm"><b>Jl. CIMANUK NO.145 GARUT</b></td>
                </tr>
                <tr>
                    <td><b>No</b></td>
                    <td align="center"><b>:</b></td>
                    <td><b>{{ $transaksi->kode_transaksi }}</b></td>
                </tr>
                <tr>
                    <td><b>Tanggal</b></td>
                    <td align="center"><b>:</b></td>
                    <td><b>{{ $transaksi->tanggal_penjualan }}</b></td>
                </tr>
                <tr>
                    <td><b>Kasir</b></td>
                    <td align="center"><b>:</b></td>
                    <td><b>{{ $transaksi->nama }}</b></td>
                </tr>
            </table>
            <br>
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td align="center" width="35%"><b>Barang</b></h1></td>
                    <td align="center" width="10%"><b>Q</b></h1></td>
                    <td align="center" width="25%"><b>Harga</b></h1></td>
                    <td align="center" width="25%"><b>Total</b></h1></td>
                </tr>
                <tr>
                     <td align="left" align="left" colspan="4">{{ str_repeat("=", 38) }}</td>
                </tr>
                @foreach ($penjualan as $item)
                    <tr style="padding-bottom: 1mm">
                        <td align="left" width="35%"><b>{{ $item->nama_barang }}</b></h1></td>
                        <td align="center" width="10%"><b>{{ $item->jumlah_barang }}</b></h1></td>
                        <td align="right" width="25%"><b>{{ number_format($item->harga_jual, 0, ',', '.') }}</b></h1></td>
                        <td align="right" width="25%"><b>{{ number_format($item->total, 0, ',', '.') }}</b></h1></td>
                    </tr>
                @endforeach
                <tr>
                     <td align="left" align="left" colspan="4" style="padding-bottom: 2mm">{{ str_repeat("=", 38) }}</td>
                </tr>
                <tr>
                    <td align="left" width="75%" colspan="3"><b>Total</b></h1></td>
                    <td align="right" width="25%"><b>{{ number_format($transaksi->total, 0, ',', '.') }}</b></h1></td>
                </tr>
                <tr>
                    <td align="left" width="75%" colspan="3"><b>Bayar</b></h1></td>
                    <td align="right" width="25%"><b>{{ number_format($transaksi->bayar, 0, ',', '.') }}</b></h1></td>
                </tr>
                <tr>
                    <td align="left" width="75%" colspan="3"><b>Sisa</b></h1></td>
                    <td align="right" width="25%"><b>{{ ($transaksi->sisa > 0) ? number_format($transaksi->sisa, 0, ',', '.') : 0 }}</b></h1></td>
                </tr>
            </table>
            <br>
            <center>
                <h4><strong>Barang yang telah dibeli tidak dapat ditukar/dikembalikan.</strong></h4>
            </center>
        </section>

    </body>
    <script>
        var lama = 1000;
        t = null;
        function printOut(){
            window.print();
            t = setTimeout("self.close()",lama);
        }
    </script>
</html>

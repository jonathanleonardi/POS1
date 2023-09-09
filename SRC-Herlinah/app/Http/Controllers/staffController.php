<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class staffController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        # code...
        $transaksiModel = new Transaksi();
        $transaksi = $transaksiModel->getTransaksi();

        return view('pages.staff_toko.dash_staff')
            ->with(
                'transaksi',
                $transaksi
            );
    }

    public function createTransaksi()
    {
        $barangModel = new Barang();
        $transaksiModel = new Transaksi();

        $barang = $barangModel->getAll();
        $invoice = $transaksiModel->getInvoice(date('Ymd'));

        return view('/pages.staff_toko.transaksi')->with([
            'barangs' => $barang,
            'invoice' => $invoice,
            'isPrint' => false,
        ]);
    }

    public function updateTransaksi($idTransaksi)
    {
        $barangModel = new Barang();
        $transaksiModel = new Transaksi();
        $penjulanaModel = new Penjualan();

        $barang = $barangModel->getAll();
        $penjualan = $penjulanaModel->getPenjualan('penjualan.id_transaksi', '=', $idTransaksi);
        $transaksi = $transaksiModel->getTransaksi('transaksi.id_transaksi', '=', $idTransaksi);

        foreach ($transaksi as $key => $value);
        $invoice = $value->kode_transaksi;

        return view('/pages.staff_toko.update_transaksi')->with([
            'barangs' => $barang,
            'transaksi' => $value,
            'penjualan' => $penjualan,
            'invoice' => $invoice,
            'isPrint' => false,
        ]);
    }

    public function transaksi(Request $request)
    {
        $data = $request->data;
        $response['success'] = false;
        $response['message'] = '';
        $response['id_transaksi'] = null;

        $transaksi = new Transaksi;
        $transaksi->kode_transaksi = $data['transaksi']['kode_transaksi'];
        $transaksi->tanggal_penjualan = $data['transaksi']['tanggal_penjualan'];
        $transaksi->status = $data['transaksi']['status'];
        $transaksi->id_user = $data['transaksi']['id_user'];
        $transaksi->total = $data['transaksi']['total'];
        $transaksi->bayar = $data['transaksi']['bayar'];
        $transaksi->save();

        $item = $data['item'];
        foreach ($item as $key => $value) {
            $item[$key]['id_transaksi'] = $transaksi->id_transaksi;
        }

        if (Penjualan::insert($item)) {
            $response['success'] = true;
            $response['message'] = 'Transaksi berhasil disimpan';
            $response['id_transaksi'] = $transaksi->id_transaksi;

            return response()->json($response, 200,);
        } else {
            $response['message'] = 'Transaksi gagal disimpan';

            return response()->json($response, 200,);
        }
    }

    public function editTransaksi(Request $request)
    {
        # code...
        $data = $request->data;
        $item = $data['item'];
        $penjualan = '';

        $response['success'] = false;
        $response['message'] = '';
        $response['id_transaksi'] = null;

        $response['success'] = false;
        $response['message'] = '';
        $response['id_transaksi'] = $data['transaksi']['id_transaksi'];

        $update = Transaksi::where('id_transaksi', $data['transaksi']['id_transaksi'])
            ->update([
                'total' => $data['transaksi']['total'],
                'bayar' => $data['transaksi']['bayar'],
                'status' => $data['transaksi']['status'],
            ]);

        if ($update != '') {
            foreach ($item as $key => $value) {
                # code...
                if ($item[$key]['id_penjualan'] != null) {
                    $penjualan = Penjualan::where('id_penjualan', $item[$key]['id_penjualan'])
                        ->update([
                            'harga_jual' => $item[$key]['harga_jual'],
                            'harga_beli' => $item[$key]['harga_beli'],
                            'jumlah_barang' => $item[$key]['jumlah_barang'],
                            'total' => $item[$key]['total']
                        ]);
                } else {
                    $penjualan = new Penjualan();

                    $penjualan->id_transaksi = $item[$key]['id_transaksi'];
                    $penjualan->tanggal_penjualan = $item[$key]['tanggal_penjualan'];
                    $penjualan->id_barang = $item[$key]['id_barang'];
                    $penjualan->jumlah_barang = $item[$key]['jumlah_barang'];
                    $penjualan->harga_jual = $item[$key]['harga_jual'];
                    $penjualan->harga_beli = $item[$key]['harga_beli'];
                    $penjualan->total = $item[$key]['total'];

                    $penjualan = $penjualan->save();
                }
            }

            if ($penjualan != '') {
                $response['success'] = true;
                $response['message'] = 'Update berhasil';

                return response()->json($response, 200,);
            } else {
                $response['message'] = $penjualan;

                return response()->json($response, 200,);
            }
        }

        return response()->json($update, 200,);
    }

    public function deleteItem(Request $request)
    {
        # code...
        $id_penjualan = $request->id_penjualan;
        $response['success'] = false;
        $response['message'] = '';
        if (Penjualan::where('id_penjualan', $id_penjualan)->delete()) {
            $response['success'] = true;
            $response['message'] = 'Data berhasil dihapus';

            return response()->json($response, 200,);
        } else {
            $response['message'] = 'Data gagal dihapus';

            return response()->json($response, 200,);
        }
    }

    public function cetakNota($id_transaksi)
    {
        # code...
        $transaksiModel = new Transaksi();
        $penjualanModel = new Penjualan();
        $penjualan = $penjualanModel->getPenjualan('penjualan.id_transaksi', '=', $id_transaksi);
        foreach ($transaksiModel->getTransaksi('transaksi.id_transaksi', '=', $id_transaksi) as $transaksi);

        return view('/printStruk')->with([
            'transaksi' => $transaksi,
            'penjualan' => $penjualan
        ]);
    }

    public function deleteTransaksi($id_transaksi)
    {
        // Penjualan::where('id_penjualan', $id_transaksi)->delete();
        // return redirect('/transaksi')->with('successDeleteBarang', 'Barang Berhasil Dihapus');
    }
}

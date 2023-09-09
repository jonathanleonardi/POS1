<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransactionReport;

class pemilikController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function home()
    {
        $staff = Staff::where('role_id', 1)->count();
        $barang = Barang::all()->count();
        return view('pages.pemilik_toko.dash_pemilik')->with([
            'staffs' => $staff, 'barangs' => $barang
        ]);
    }

    // -------------- STAFF --------------
    public function dataStaff()
    {
        $staff = Staff::where('role_id', 1)->get();
        return view('pages.pemilik_toko.data_staff')->with('staffs', $staff);
    }

    public function createStaff()
    {
        $userModel = new User();
        $kode_staff = $userModel->getKodeStaff('STAFF-');

        return view('/pages.pemilik_toko.tambah_staff')
            ->with('kode', $kode_staff);
    }

    public function tambahStaff(Request $request)
    {
        $pattern = "/[a-zA-Z0-9]+@gmail.com/";
        if (!preg_match_all($pattern, $request->emailStaff)) {
            return redirect('/tambahStaff')->with('wrongFormat', 'Format Email Salah (example@gmail.com)');
        }
        $staffCheckID = Staff::where('id_user', $request->idStaff)->first();
        $staffCheckEmail = Staff::where('email', $request->emailStaff)->first();
        if ($staffCheckID != null) {
            return redirect('/tambahStaff')->with('failedAddStaff', 'ID Staff Toko Telah Digunakan');
        } else if ($staffCheckEmail != null) {
            return redirect('/tambahStaff')->with('failedAddStaff', 'Email Staff Toko Telah Digunakan');
        } else {
            $staff = new Staff();
            $staff->kode_user = $request->idStaff;
            $staff->nama = $request->namaStaff;
            $staff->email = $request->emailStaff;
            $staff->password = '123456';
            $staff->role_id = 1;
            $staff->save();
            return redirect('/dataStaff')->with('successAddStaff', 'Staff Toko Berhasil Ditambahkan');
        }
    }

    public function editStaff(Staff $staff)
    {
        return view('/pages.pemilik_toko.edit_staff')->with(['modal' => true, 'staff' => $staff]);
    }

    public function saveEditStaff(Request $request)
    {
        Staff::where('id_user', $request->idStaff)->update(['nama' => $request->namaStaff, 'email' => $request->emailStaff]);
        return redirect('/dataStaff')->with('successEditStaff', "Staff Toko Berhasil Diperbaharui");
    }

    public function deleteStaff($id_staff)
    {
        Staff::where('id_user', $id_staff)->first()->delete();
        return redirect('/dataStaff')->with('successDeleteStaff', 'Staff Toko Berhasil Dihapus');
    }

    // -------------- BARANG MASUK --------------
    public function createBarangMasuk()
    {
        $barangModel = new Barang();
        $barang = $barangModel->getAll();

        return view('pages.pemilik_toko.tambah_barang_masuk')
            ->with('barangs', $barang);
    }

    public function updateBarangMasuk($idBarangMasuk)
    {
        $pembelianModel = new Pembelian();
        $pembelian = $pembelianModel->getAll('pembelian.id_pembelian', '=', $idBarangMasuk);
        foreach ($pembelian as $key => $value);

        return view('pages.pemilik_toko.edit_barang_masuk')
            ->with('pembelian', $value);
    }

    public function tambahBarangMasuk(Request $request)
    {
        $pembelian = new Pembelian();
        $pembelian->id_barang = $request->id;
        $pembelian->tanggal = $request->tanggal;
        $pembelian->jumlah_barang = $request->jumlah_barang;
        $pembelian->harga_beli = $request->harga_beli;

        $pembelian->save();
        return redirect('/dataBarang')->with('successAddBarang', 'Barang Masuk Berhasil Ditambahkan');
    }

    public function saveEditBarangMasuk(Request $request)
    {
        Pembelian::where('id_pembelian', $request->id_pembelian)
            ->update(
                [
                    'harga_beli' => $request->harga_beli,
                    'jumlah_barang' => $request->jumlah_barang,
                ]
            );
        return redirect('/viewReportPembelian')->with('successEditBarang', "Barang Masuk Berhasil Diperbaharui");
    }

    public function deleteBarangMasuk($id_pembelian)
    {
        Pembelian::where('id_pembelian', $id_pembelian)->delete();
        return redirect('/viewReportPembelian')->with('successDeleteBarang', 'Barang Masuk Berhasil Dihapus');
    }

    // -------------- BARANG --------------
    public function dataBarang()
    {
        $barangModel = new Barang();
        $barang = $barangModel->getAll();

        return view('pages.pemilik_toko.data_barang')->with('barangs', $barang);
    }

    public function createBarang()
    {
        return view('/pages.pemilik_toko.tambah_barang');
    }

    public function tambahBarang(Request $request)
    {
        $barangCheckID = Barang::where('kode_barang', $request->kode_barang)->first();
        $barangCheckNama = Barang::where('nama_barang', $request->namaBarang)->first();


        if ($barangCheckID != null) {
            return redirect('/tambahBarang')->with('failedAddBarang', 'Kode Barang Telah Digunakan');
        }
        if ($barangCheckNama != null) {
            return redirect('/tambahBarang')->with('failedAddBarang', 'Nama Barang Telah Digunakan');
        } else {
            $barang = new Barang();
            $barang->kode_barang = $request->kode_barang;
            $barang->nama_barang = $request->nama_barang;
            $barang->keuntungan = $request->keuntungan;
            // $barang->satuan = $request->satuan;
            $barang->save();
            return redirect('/dataBarang')->with('successAddBarang', 'Barang Berhasil Ditambahkan');
        }
    }

    public function editBarang($idBarang)
    {
        $barangModel = new Barang();
        $barang = $barangModel->getAll('barang.id', '=', $idBarang);
        foreach ($barang as $value);

        return view('/pages.pemilik_toko.edit_barang')->with(['modal' => true, 'barang' => $value]);
    }

    public function saveEditBarang(Request $request)
    {
        Barang::where('id', $request->id_barang)
            ->update(
                [
                    'nama_barang' => $request->namaBarang,
                    'keuntungan' => $request->keuntungan,
                    // 'satuan' => $request->satuan,
                ]
            );
        return redirect('/dataBarang')->with('successEditBarang', "Barang Berhasil Diperbaharui");
    }

    public function deleteBarang($id_barang)
    {
        Barang::where('id', $id_barang)->delete();
        return redirect('/dataBarang')->with('successDeleteBarang', 'Barang Berhasil Dihapus');
    }

    // -------------- TRANSAKSI --------------
    public function showLaporan()
    {
        $transaksiModel = new Transaksi();
        $transaksi = $transaksiModel->getTransaksi();
        return view('pages.pemilik_toko.viewReport')
            ->with(
                'transaksi',
                $transaksi
            );
    }

    public function deleteTransaksi($idTransaksi)
    {
        # code...
        Transaksi::where('id_transaksi', $idTransaksi)->delete();
        if (session('user')->role_id == 1) {
            return redirect('/staffToko')->with('successDeleteBarang', 'Transaksi Berhasil Dihapus');
        } else {
            return redirect('/viewReport')->with('successDeleteBarang', 'Transaksi Berhasil Dihapus');
        }
    }

    public function showLaporanPembelian()
    {
        $pembelianModel = new Pembelian();
        $pembelian = $pembelianModel->getAll();

        return view('pages.pemilik_toko.viewReportPembelian')->with('pembelians', $pembelian);
    }

    public function cetakLaporan($awal, $akhir)
    {
        return (new TransactionReport($awal, $akhir))->download('report ' . $awal . '_' . $akhir . '.xlsx');
    }
}

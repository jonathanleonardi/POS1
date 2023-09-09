<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaksi extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $keyType = 'int';
    protected $fillable = ['id_transaksi', 'kode_transaksi', 'tanggal_penjualan', 'status', 'id_user', 'bayar', 'total'];

    public function getInvoice($perfix)
    {
        $q = DB::table('transaksi')->select(DB::raw('MAX(RIGHT(kode_transaksi,5)) as kd_max, LEFT(kode_transaksi,8) as perfix'));
        if ($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = intval($k->kd_max) + 1;
            }
            $kd = $perfix . sprintf("%05s", $tmp);
        } else {
            $kd = $perfix . sprintf("%05s", 1);
        }

        return $kd;
    }

    public function getTransaksi($column = null, $operator = '=', $value = null)
    {
        # code...
        $transaksi = DB::table('transaksi')
            ->select(
                DB::raw(
                    'transaksi.id_transaksi, transaksi.kode_transaksi, transaksi.tanggal_penjualan, SUM(penjualan.total) as total, transaksi.bayar,
                    (transaksi.bayar - SUM(penjualan.total)) AS sisa, transaksi.id_user, user.nama, transaksi.status,
                    IF(transaksi.status <> "0", "Tunai", "Tunda" ) as statusnya'
                )
            );

        $transaksi->leftJoin('user', 'transaksi.id_user', '=', 'user.id_user');
        $transaksi->leftJoin('penjualan', 'transaksi.id_transaksi', '=', 'penjualan.id_transaksi');

        if (!empty($column) && !empty($value))
            $transaksi->where($column, $operator, $value);

        $transaksi
            ->groupBy('transaksi.id_transaksi')
            ->orderby('transaksi.tanggal_penjualan', 'desc');

        return $transaksi->get();
    }

    public function getReport($awal, $akhir)
    {
        # code...
        $transaksi = DB::table('transaksi')
            ->select(
                DB::raw(
                    'transaksi.id_transaksi, transaksi.kode_transaksi, transaksi.tanggal_penjualan, SUM(penjualan.total) as total, transaksi.bayar,
                    (transaksi.bayar - SUM(penjualan.total)) AS sisa, transaksi.id_user, user.nama, transaksi.status,
                    IF(transaksi.status <> "0", "Tunai", "Tunda" ) as statusnya'
                )
            );

        $transaksi->leftJoin('user', 'transaksi.id_user', '=', 'user.id_user');
        $transaksi->leftJoin('penjualan', 'transaksi.id_transaksi', '=', 'penjualan.id_transaksi');

        $transaksi->groupBy('transaksi.id_transaksi');

        return $transaksi
            ->orWhereBetween('transaksi.tanggal_penjualan', [$awal, $akhir])
            ->orderby('transaksi.tanggal_penjualan', 'desc')
            ->get();
    }
}

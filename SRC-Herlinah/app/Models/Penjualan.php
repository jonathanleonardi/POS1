<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Penjualan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'penjualan';
    protected $primaryKey = 'id_penjualan';
    protected $keyType = 'int';
    protected $fillable = ['id_penjualan', 'id_transaksi', 'tanggal_penjualan', 'id_barang', 'harga_jual', 'harga_beli', 'jumlah_barang', 'total'];



    public function getPenjualan($column = null, $operator = '=', $value = null)
    {
        # code...
        $transaksi = DB::table('penjualan')
            ->select(
                DB::raw(
                    'penjualan.id_penjualan, penjualan.tanggal_penjualan, penjualan.id_transaksi, penjualan.id_barang, barang.kode_barang,
                    barang.nama_barang, penjualan.jumlah_barang, penjualan.harga_jual, penjualan.harga_beli, penjualan.total '
                )
            );

        $transaksi->leftJoin('barang', 'penjualan.id_barang', '=', 'barang.id');

        if (!empty($column) && !empty($value))
            $transaksi->where($column, $operator, $value);

        $transaksi
            ->orderby('penjualan.tanggal_penjualan', 'desc');

        return $transaksi->get();
    }
}

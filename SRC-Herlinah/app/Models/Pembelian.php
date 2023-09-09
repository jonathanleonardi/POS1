<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pembelian extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'pembelian';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $fillable = ['id_pembelian', 'id_barang', 'tanggal', 'jumlah_barang', 'harga_beli'];

    public function getAll($column = null, $operator = '=', $value = null)
    {
        $pembelian = DB::table('pembelian')
            ->select(
                DB::raw(
                    'pembelian.id_pembelian,
                    pembelian.tanggal,
                    pembelian.id_barang,
                    barang.kode_barang,
                    barang.nama_barang,
                    pembelian.harga_beli,
                    pembelian.jumlah_barang,
                    pembelian.jumlah_barang * pembelian.harga_beli AS total'
                )
            )
            ->leftJoin('barang', 'barang.id', '=', 'pembelian.id_barang');

        if (!empty($column) && !empty($value))
            $pembelian->where($column, $operator, $value);

        $pembelian
            ->orderby('pembelian.tanggal', 'desc');

        return $pembelian->get();
    }
}

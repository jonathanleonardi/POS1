<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Barang extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'barang';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $fillable = ['id_barang', 'kode_barang', 'nama_barang', 'keuntungan', 'stok', 'satuan'];

    public function getAll($column = null, $operator = '=', $value = null)
    {
        $barang = DB::table('barang')
            ->select(
                DB::raw(
                    'barang.*,
                    if((SELECT if(harga_beli <> 0, harga_beli, 0) FROM pembelian where id_barang = barang.id ORDER BY tanggal DESC LIMIT 1) <> 0,
                        (SELECT if(harga_beli <> 0, harga_beli, 0) FROM pembelian where id_barang = barang.id ORDER BY tanggal DESC LIMIT 1), 0) AS harga_beli,
                    if( (SELECT if(harga_beli <> 0, harga_beli, 0) FROM pembelian where id_barang = barang.id ORDER BY tanggal DESC LIMIT 1) <> 0,
                        (SELECT if(harga_beli <> 0, harga_beli, 0) FROM pembelian where id_barang = barang.id ORDER BY tanggal DESC LIMIT 1) + barang.keuntungan, 0)
                        AS harga_jual'
                )
            )
            ->leftJoin('pembelian', 'pembelian.id_barang', '=', 'barang.id');

        if (!empty($column) && !empty($value))
            $barang->where($column, $operator, $value);

        $barang
            ->groupBy('barang.id')
            ->orderby('barang.id', 'desc');

        return $barang->get();
    }
}

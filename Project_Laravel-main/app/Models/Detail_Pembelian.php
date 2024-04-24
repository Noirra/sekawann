<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Detail_Pembelian extends Model
{
    use HasFactory;

    protected $table = 'detail_pembelian';
    protected $primaryKey = 'detail_pembelian_id';
    protected $fillable = [
        'detail_pembelian_id',
        'detail_pembelian_pembelian_id',
        'detail_pembelian_pakaian_id',
        'detail_pembelian_jumlah',
        'detail_pembelian_total_harga',
    ];
    protected static function createDetail_Pembelian ($data)
    {
        return DB::table('detail_pembelian')->insert($data);
    }
    protected static function readDetail_PembelianAll ()
    {
        $data = DB::table('detail_pembelian')->get();
        return $data;
    }
    protected static function readDetail_PembelianPaginate ()
    {
        $data = DB::table('detail_pembelian')->paginate(10);
        return $data;
    }
    protected static function readDetail_PembelianById ($id)
    {
        $data = DB::table('detail_pembelian')->where('detail_pembelian_id', $id)->first();
        return $data;
    }
    protected static function updateDetail_Pembelian ($id, $data)
    {
        $detail_pembelian = DB::table('detail_pembelian')->where('detail_pembelian_id', $id)->first();
        if ($detail_pembelian) {
            DB::table('detail_pembelian')->where('detail_pembelian_id', $id)->update($data);
            return $data;
        }
        return null;
    }
    protected static function deleteDetail_Pembelian ($id)
    {
        return DB::table('detail_pembelian')->where('detail_pembelian_id', $id)->delete();
    }
}
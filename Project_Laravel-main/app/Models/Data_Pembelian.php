<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Data_Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';
    protected $primaryKey = 'pembelian_id';
    protected $fillable = [
        'pembelian_id',
        'pembelian_user_id',
        'pembelian_metode_pembayaran_id',
        'pembelian_tanggal',
        'pembelian_total_harga',
        'pembelian_status',
    ];
    protected static function createData_Pembelian ($data)
    {
        return DB::table('pembelian')->insert($data);
    }
    protected static function readData_PembelianAll ()
    {
        $data = DB::table('pembelian')->get();
        return $data;
    }
    protected static function readData_PembelianPaginate ()
    {
        $data = DB::table('pembelian')->paginate(10);
        return $data;
    }
    protected static function readData_PembelianById ($id)
    {
        $data = DB::table('pembelian')->where('pembelian_id', $id)->first();
        return $data;
    }
    protected static function updateData_Pembelian ($id, $data)
    {
        $pembelian = DB::table('pembelian')->where('pembelian_id', $id)->first();
        if ($pembelian) {
            DB::table('pembelian')->where('pembelian_id', $id)->update($data);
            return $data;
        }
        return null;
    }
    protected static function deleteData_Pembelian ($id)
    {
        return DB::table('pembelian')->where('pembelian_id', $id)->delete();
    }
}
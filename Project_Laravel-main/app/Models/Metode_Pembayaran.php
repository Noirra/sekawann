<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Metode_Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'metode_pembayaran';
    protected $primaryKey = 'metode_pembayaran_id';
    protected $fillable = [
        'metode_pembayaran_id',
        'metode_pembayaran_user_id',
        'metode_pembayaran_jenis',
        'metode_pembayaran_nama',
        'metode_pembayaran_nomor',
    ];
    protected static function createMetode_Pembayaran ($data)
    {
        return DB::table('metode_pembayaran')->insert($data);
    }
    protected static function readMetode_PembayaranAll ()
    {
        $data = DB::table('metode_pembayaran')->get();
        return $data;
    }
    protected static function readMetode_PembayaranPaginate ()
    {
        $data = DB::table('metode_pembayaran')->paginate(10);
        return $data;
    }
    protected static function readMetode_PembayaranById ($id)
    {
        $data = DB::table('metode_pembayaran')->where('metode_pembayaran_id', $id)->first();
        return $data;
    }
    protected static function updateMetode_Pembayaran ($id, $data)
    {
        $metode_pembayaran = DB::table('metode_pembayaran')->where('metode_pembayaran_id', $id)->first();
        if ($metode_pembayaran) {
            DB::table('metode_pembayaran')->where('metode_pembayaran_id', $id)->update($data);
            return $data;
        }
        return null;
    }
    protected static function deleteMetode_Pembayaran ($id)
    {
        return DB::table('metode_pembayaran')->where('metode_pembayaran_id', $id)->delete();
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kategori_Pakaian extends Model
{
    use HasFactory;

    protected $table = 'kategori_pakaian';
    protected $primaryKey = 'kategori_pakaian_id';
    protected $fillable = [
        'kategori_pakaian_id',
        'kategori_pakaian_nama',
        'kategori_pakaian_kode',
        'kategori_pakaian_status',
    ];
    protected static function createKategori_Pakaian ($data)
    {
        return DB::table('kategori_pakaian')->insert($data);
    }
    protected static function readKategori_PakaianAll ()
    {
        $data = DB::table('kategori_pakaian')->get();
        return $data;
    }
    protected static function readKategori_PakaianPaginate ()
    {
        $data = DB::table('kategori_pakaian')->paginate(10);
        return $data;
    }
    protected static function readKategori_PakaianById ($id)
    {
        $data = DB::table('kategori_pakaian')->where('kategori_pakaian_id', $id)->first();
        return $data;
    }
    protected static function updateKategori_Pakaian ($id, $data)
    {
        $kategori_pakaian = DB::table('kategori_pakaian')->where('kategori_pakaian_id', $id)->first();
        if ($kategori_pakaian) {
            DB::table('kategori_pakaian')->where('kategori_pakaian_id', $id)->update($data);
            return $data;
        }
        return null;
    }
    protected static function deleteKategori_Pakaian ($id)
    {
        return DB::table('kategori_pakaian')->where('kategori_pakaian_id', $id)->delete();
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Data_Pakaian extends Model
{
    use HasFactory;

    protected $table = 'pakaian';
    protected $primaryKey = 'pakaian_id';
    protected $fillable = [
        'pakaian_id',
        'pakaian_kategori_pakaian_id',
        'pakaian_nama',
        'pakaian_harga',
        'pakaian_stok',
        'pakaian_gambar_url',
    ];
    protected static function createData_Pakaian($data, UploadedFile $gambar = null)
    {
        $pakaian = $data;
        if ($gambar) {
            $path = $gambar->store('pakaian/gambar');
            $pakaian['pakaian_gambar_url'] = $path;
        }
        DB::table('pakaian')->insert($pakaian);
    }    
    protected static function readData_PakaianAll ()
    {
        $data = DB::table('pakaian')->get();
        return $data;
    }
    protected static function readData_PakaianPaginate ()
    {
        $data = DB::table('pakaian')->paginate(10);
        return $data;
    }
    protected static function readData_PakaianById ($id)
    {
        $data = DB::table('pakaian')->where('pakaian_id', $id)->first();
        return $data;
    }
    protected static function upload_gambar ($id, $data)
    {
        $pakaian = self::find($id);
        if ($pakaian->pakaian_gambar_url) {
            Storage::delete($pakaian->pakaian_gambar_url);
        }
        if ($data) {
            $path = $data->store('pakaian/gambar');
            $pakaian->pakaian_gambar_url = $path;
        }
        $pakaian->save();
    }
    protected static function updateData_Pakaian ($id, $data, UploadedFile $gambar = null)
    {
        $pakaian = DB::table('pakaian')->where('pakaian_id', $id)->first();
        if ($pakaian) {
            if ($gambar && $pakaian->pakaian_gambar_url) {
                Storage::delete($pakaian->pakaian_gambar_url);
                $path = $gambar->store('pakaian/gambar');
                $data['pakaian_gambar_url'] = $path;
            }
            DB::table('pakaian')->where('pakaian_id', $id)->update($data);
            return $data;
        }
        return null;
    }
    protected static function deleteData_Pakaian ($id)
    {
        return DB::table('pakaian')->where('pakaian_id', $id)->delete();
    }
}
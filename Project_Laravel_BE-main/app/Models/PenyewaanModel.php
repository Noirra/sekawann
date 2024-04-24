<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PelangganModel;

class PenyewaanModel extends Model
{
    use HasFactory;

    protected $table = 'penyewaan';
    protected $primaryKey = 'penyewaan_id';
    protected $fillable = [
        'penyewaan_pelanggan_id',
        'penyewaan_tglsewa',
        'penyewaan_tglkembali',
        'penyewaan_sttspembayaran',
        'penyewaan_sttskembali',
        'penyewaan_totalharga',
    ];

    // Relasi ke model Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(PelangganModel::class, 'penyewaan_pelanggan_id', 'pelanggan_id');
    }
    public function getAllPenyewaan()
    {
        return $this->all();
    }

    public function findPenyewaan($id)
    {
        return $this->find($id);
    }

    public function createPenyewaan($data)
    {
        return $this->create($data);
    }

    public function updatePenyewaan($data, $id)
    {
        $penyewaan = $this->find($id);
        $penyewaan->fill($data);
        $penyewaan->save();

        return $penyewaan;
    }

    public function deletePenyewaan($id)
    {
        $penyewaan = $this->find($id);

        if ($penyewaan) {
            $penyewaan->delete();
        }

        return $penyewaan;
    }
}

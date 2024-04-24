<?php

namespace App\Http\Controllers;

use App\Models\AlatModel;
use App\Models\PenyewaanModel;
use App\Models\Penyewaan_DetailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PenyewaanController extends Controller
{
    protected $penyewaanModel;

    public function __construct()
    {
        $this->penyewaanModel = new PenyewaanModel;
    }
    
    public function index()
    {
        
            $penyewaan = $this->penyewaanModel->get();
            
            if ($penyewaan->isEmpty()) {
                return response()->json([
                    'message' => 'Data Penyewaan masih kosong',
                    'data' => $penyewaan
                ], 404);
            }
            return response()->json([
                'message' => 'Data Penyewaan berhasil didapatkan',
                'data' => $penyewaan
            ], 200);
        
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'penyewaan_sttspembayaran' => 'required|in:Lunas,Belum Dibayar,DP',
            'penyewaan_sttskembali' => 'required|in:Sudah Kembali,Belum Kembali',
            'penyewaan_totalharga' => 'required|integer',
            'penyewaan_pelanggan_id' => 'required|exists:pelanggan,pelanggan_id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422, 
                'message' => 'Validasi pada data penyewaan gagal!', 
                'errors' => $validator->errors()
            ], 422);
        }

        $penyewaanData = $validator->validated();
        $penyewaan = $this->penyewaanModel->createPenyewaan($penyewaanData);

        return response()->json([
            'status' => 201,
            'message' => 'Data penyewaan berhasil dibuat!', 
            'data' => $penyewaan
        ], 201);
    }


    public function show($id)
    {
        try {
            $penyewaan = $this->penyewaanModel->find($id);

            if (!$penyewaan) {
                return response()->json([
                    'message' => 'Data Penyewaan tidak ditemukan',
                    'data' => $penyewaan
                ], 404);
            } else {
                return response()->json([
                    'message' => 'Data Penyewaan berhasil ditemukan',
                    'data' => $penyewaan
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi Kesalahan pada Server',
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'penyewaan_sttspembayaran' => 'required|in:Lunas,Belum Dibayar, DP',
            'penyewaan_sttskembali' => 'required|in:Sudah Kembali,Belum Kembali',
            'penyewaan_totalharga' => 'required|integer',
            'penyewaan_pelanggan_id' => 'required|exists:pelanggan,pelanggan_id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422, 
                'message' => 'Validasi pada data penyewaan gagal!', 
                'errors' => $validator->errors()
            ], 422);
        }

        $penyewaan = $this->penyewaanModel->updatePenyewaan($validator->validated(), $id);

        return response()->json([
            'status' => 200, 
            'message' => 'Data penyewaan berhasil diupdate!', 
            'data' => $penyewaan
        ], 200);
    }

    public function destroy($id)
    {
        $penyewaan = $this->penyewaanModel->deletePenyewaan($id);

        return response()->json([
            'status' => 200, 
            'message' => 'Data penyewaan berhasil dihapus!', 
            'data' => $penyewaan
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan_DataModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class Pelanggan_DataController extends Controller
{
    protected $pelanggan_dataModel;
    public function __construct()
    {
        $this->pelanggan_dataModel = new Pelanggan_DataModel;
    }
    public function index()
    {
        $pelanggan_data = $this->pelanggan_dataModel->get();

        if ($pelanggan_data->isEmpty()) {
            return response()->json([
                'message' => 'Data Pelanggan Data masih kosong',
                'data' => $pelanggan_data,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data Pelanggan Data berhasil didapatkan',
                'data' => $pelanggan_data,
            ], 200);
        }
    }

    public function store(Request $request)
    {
        try {
            //throw new \Exception('error 500');

            $validator = Validator::make($request->all(), [
                'pelanggan_data_pelanggan_id' => 'required|exists:pelanggan,pelanggan_id',
                'pelanggan_data_jenis' => 'required|in:KTP,SIM',
                'pelanggan_data_file' => 'required|image|mimes:jpg,png,jpeg',
            ], [
                'required' => 'Kolom :attribute tidak boleh kosong',
                
                'pelanggan_data_jenis.in' => 'Pelanggan Data Jenis harus diisi KTP atau SIM',
                'pelanggan_data_file.required' => 'File harus diunggah',
                'pelanggan_data_file.image' => 'File harus berupa gambar',
                'pelanggan_data_file.mimes' => 'File harus memiliki format .jpg, .png, atau .jpeg',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }


            $file = $request->file('pelanggan_data_file');
            $filename = $file->getClientOriginalName();
            $filepath = $file->storeAs('pelanggan_data_file', $filename);

            $pelanggan_data = $this->pelanggan_dataModel->create([
                'pelanggan_data_pelanggan_id' => $request->pelanggan_data_pelanggan_id,
                'pelanggan_data_jenis' => $request->pelanggan_data_jenis,
                'pelanggan_data_file' => $filepath,
            ]);

            return response()->json([
                'message' => 'Data Pelanggan Data berhasil dibuat',
                'data' => $pelanggan_data
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan pada server!'
            ], 500);
        }
    }

    public function update(Request $request, string $id)
{
    try {
        $this->validate($request, [
            'pelanggan_data_pelanggan_id' => 'required|exists:pelanggan,pelanggan_id',
            'pelanggan_data_jenis' => 'required|in:KTP,SIM',
            'pelanggan_data_file' => 'nullable|image|mimes:jpg,png,jpeg',
        ], [
            'required' => 'Kolom :attribute tidak boleh kosong',
            'pelanggan_data_pelanggan_id.exists' => 'ID Pelanggan tidak valid',
            'pelanggan_data_jenis.in' => 'Pelanggan Data Jenis harus diisi KTP atau SIM',
            'pelanggan_data_file.required' => 'File harus diunggah',
            'pelanggan_data_file.image' => 'File harus berupa gambar',
            'pelanggan_data_file.mimes' => 'File harus memiliki format .jpg, .png, atau .jpeg',
        ]);

        $pelanggan_data = $this->pelanggan_dataModel->find($id);

        if (!$pelanggan_data) {
            return response()->json([
                'message' => 'Data Pelanggan Data tidak ditemukan'
            ], 404);
        }

        if ($request->hasFile('pelanggan_data_file')) {
            Storage::delete($pelanggan_data->pelanggan_data_file); 
            $file = $request->file('pelanggan_data_file')->store('pelanggan_data'); 
        } else {
            $file = $pelanggan_data->pelanggan_data_file;
        }

        $pelanggan_data->update([
            'pelanggan_data_pelanggan_id' => $request->pelanggan_data_pelanggan_id,
            'pelanggan_data_jenis' => $request->pelanggan_data_jenis,
            'pelanggan_data_file' => $file, 
        ]);

        return response()->json([
            'message' => 'Data Pelanggan Data berhasil diperbarui',
            'data' => $pelanggan_data
        ], 200);
    } catch (ValidationException $e) {
        return response()->json([
            'message' => 'Validasi Gagal',
            'errors' => $e->validator->errors(),
        ], 422);
    } catch (RouteNotFoundException $e) {
        return response()->json([
            'message' => 'Unauthorized'
        ], 401);
    }
}




    public function destroy(string $id)
    {
        $pelanggan_data = $this->pelanggan_dataModel->find($id);

        if (!$pelanggan_data) {
            return response()->json([
                'message' => 'Data Pelanggan Data tidak ditemukan'
            ], 404);
        }
        $pelanggan_data->delete();
        return response()->json([
            'message' => 'Data Pelanggan Data berhasil dihapus',
            'data' => $pelanggan_data
        ], 200);
    }


    public function show(string $id)
    {
        $pelanggan_data = $this->pelanggan_dataModel->find($id);

        if (!$pelanggan_data) {
            return response()->json([
                'message' => 'Data Pelanggan Data tidak ditemukan'
            ], 404);
        }
        return response()->json([
            'message' => 'Data Pelanggan Data berhasil didapatkan',
            'data' => $pelanggan_data
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
}

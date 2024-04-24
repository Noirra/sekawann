<?php

namespace App\Http\Controllers;

use App\Models\Kategori_Pakaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Kategori_Pakaian_Controller extends Controller
{
    public function createKategori_Pakaian()
    {
        return view("web.create.kategori_pakaian");
    }
    public function updateKategori_Pakaian($id)
    {
        $data = Kategori_Pakaian::readKategori_PakaianById($id);
        return view("web.update.kategori_pakaian", [
            "kategori_pakaian" => $data,
        ]);
    }
    public function create(Request $request)
    {
        $data = [
            "kategori_pakaian_nama" => $request->input("nama"),
            "kategori_pakaian_kode" => $request->input("kode"),
            "kategori_pakaian_status" => $request->input("status"),
        ];
        Kategori_Pakaian::create($data);
        Log::info(
            "🟢 Kategori_Pakaian " .
                $request->input("nama") .
                " berhasil ditambahkan"
        );
        return redirect()
            ->back()
            ->with("success", "Data kategori_pakaian berhasil ditambahkan!");
    }
    public function update(Request $request, $id)
    {
        $ids = Kategori_Pakaian::find($id);
        if (!$ids) {
            return redirect()
                ->back()
                ->with("error", "Data kategori_pakaian tidak ditemukan.");
        }
        $data = [
            "kategori_pakaian_id" => $id,
            "kategori_pakaian_nama" => $request->input("nama"),
            "kategori_pakaian_kode" => $request->input("kode"),
            "kategori_pakaian_status" => $request->input("status"),
        ];
        $ids->update($data);
        Log::notice(
            "🟡 Kategori_Pakaian " .
                $request->input("nama") .
                " berhasil diubah"
        );
        return redirect()
            ->back()
            ->with("success", "Data kategori_pakaian berhasil diperbarui!");
    }
    public function delete($id)
    {
        $kategori_pakaian = Kategori_Pakaian::find($id);
        if ($kategori_pakaian) {
            Log::alert(
                "🔴 Kategori_Pakaian dengan ID : " . $id . " berhasil dihapus"
            );
            $kategori_pakaian->delete();
            return redirect()
                ->back()
                ->with("deleted", "Data kategori_pakaian berhasil dihapus!");
        } else {
            Log::error(
                "🔴 Kategori_Pakaian dengan ID : " . $id . " gagal dihapus"
            );
            return redirect()
                ->back()
                ->with("error", "Data kategori_pakaian tidak ditemukan.");
        }
    }
}
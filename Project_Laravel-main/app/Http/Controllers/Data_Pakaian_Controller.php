<?php

namespace App\Http\Controllers;

use App\Models\Data_Pakaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Data_Pakaian_Controller extends Controller
{
    public function createData_Pakaian()
    {
        return view("web.create.data_pakaian");
    }
    public function updateData_Pakaian($id)
    {
        $data = Data_Pakaian::readData_PakaianById($id);
        return view("web.update.data_pakaian", ["data_pakaian" => $data]);
    }
    public function create(Request $request)
    {
        $gambar = $request->file("gambar");
        $data = [
            "pakaian_kategori_pakaian_id" => $request->input("kategori"),
            "pakaian_nama" => $request->input("nama"),
            "pakaian_harga" => $request->input("harga"),
            "pakaian_stok" => $request->input("stok"),
        ];
        Data_Pakaian::createData_Pakaian($data, $gambar);
        Log::info($gambar);
        Log::info(
            "🟢 Data_Pakaian " .
                $request->input("nama") .
                " berhasil ditambahkan"
        );
        return redirect()
            ->route("data_pakaian")
            ->with("success", "Data pakaian berhasil ditambahkan!");
    }
    public function update(Request $request, $id)
    {
        $ids = Data_Pakaian::find($id);
        if (!$ids) {
            return redirect()
                ->route("pakaian")
                ->with("error", "Data pakaian tidak ditemukan.");
        }
        $gambar = $request->file("gambar");
        $data = [
            "pakaian_id" => $id,
            "pakaian_kategori_pakaian_id" => $request->input("kategori"),
            "pakaian_nama" => $request->input("nama"),
            "pakaian_harga" => $request->input("harga"),
            "pakaian_stok" => $request->input("stok"),
        ];
        Data_Pakaian::updateData_Pakaian($id, $data, $gambar);
        Log::notice(
            "🟡 Data_Pakaian " . $request->input("nama") . " berhasil diubah"
        );
        return redirect()
            ->route("data_pakaian")
            ->with("success", "Data pakaian berhasil diperbarui!");
    }
    public function delete($id)
    {
        $pakaian = Data_Pakaian::find($id);
        if ($pakaian) {
            Log::alert(
                "🔴 Data_Pakaian dengan ID : " . $id . " berhasil dihapus"
            );
            $pakaian->delete();
            return redirect()
                ->route("data_pakaian")
                ->with("deleted", "Data pakaian berhasil dihapus!");
        } else {
            Log::error("🔴 Data_Pakaian dengan ID : " . $id . " gagal dihapus");
            return redirect()
                ->route("data_pakaian")
                ->with("error", "Data pakaian tidak ditemukan.");
        }
    }
}
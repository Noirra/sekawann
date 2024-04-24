<?php

namespace App\Http\Controllers;

use App\Models\Detail_Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Detail_Pembelian_Controller extends Controller
{
    public function createDetail_Pembelian()
    {
        return view("web.create.detail_pembelian");
    }
    public function updateDetail_Pembelian($id)
    {
        $data = Detail_Pembelian::readDetail_PembelianById($id);
        return view("web.update.detail_pembelian", [
            "detail_pembelian" => $data,
        ]);
    }
    public function create(Request $request)
    {
        $data = [
            "detail_pembelian_pembelian_id" => $request->input("pembelian"),
            "detail_pembelian_pakaian_id" => $request->input("pakaian"),
            "detail_pembelian_jumlah" => $request->input("jumlah"),
            "detail_pembelian_total_harga" => $request->input("total_harga"),
        ];
        Detail_Pembelian::create($data);
        Log::info(
            "🟢 Detail_Pembelian " .
                $request->input("nama") .
                " berhasil ditambahkan"
        );
        return redirect()
            ->back()
            ->with("success", "Data detail_pembelian berhasil ditambahkan!");
    }
    public function update(Request $request, $id)
    {
        $ids = Detail_Pembelian::find($id);
        if (!$ids) {
            return redirect()
                ->back()
                ->with("error", "Data detail_pembelian tidak ditemukan.");
        }
        $data = [
            "detail_pembelian_id" => $id,
            "detail_pembelian_pembelian_id" => $request->input("pembelian"),
            "detail_pembelian_pakaian_id" => $request->input("pakaian"),
            "detail_pembelian_jumlah" => $request->input("jumlah"),
            "detail_pembelian_total_harga" => $request->input("total_harga"),
        ];
        $ids->update($data);
        Log::notice(
            "🟡 Detail_Pembelian " .
                $request->input("nama") .
                " berhasil diubah"
        );
        return redirect()
            ->back()
            ->with("success", "Data detail_pembelian berhasil diperbarui!");
    }
    public function delete($id)
    {
        $detail_pembelian = Detail_Pembelian::find($id);
        if ($detail_pembelian) {
            Log::alert(
                "🔴 Detail_Pembelian dengan ID : " . $id . " berhasil dihapus"
            );
            $detail_pembelian->delete();
            return redirect()
                ->back()
                ->with("deleted", "Data detail_pembelian berhasil dihapus!");
        } else {
            Log::error(
                "🔴 Detail_Pembelian dengan ID : " . $id . " gagal dihapus"
            );
            return redirect()
                ->back()
                ->with("error", "Data detail_pembelian tidak ditemukan.");
        }
    }
}
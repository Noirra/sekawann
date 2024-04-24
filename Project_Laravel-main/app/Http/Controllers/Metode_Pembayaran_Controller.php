<?php

namespace App\Http\Controllers;

use App\Models\Metode_Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Metode_Pembayaran_Controller extends Controller
{
    public function createMetode_Pembayaran()
    {
        return view("web.create.metode_pembayaran");
    }
    public function updateMetode_Pembayaran($id)
    {
        $data = Metode_Pembayaran::readMetode_PembayaranById($id);
        return view("web.update.metode_pembayaran", [
            "metode_pembayaran" => $data,
        ]);
    }
    public function create(Request $request)
    {
        $data = [
            "metode_pembayaran_user_id" => $request->input("user"),
            "metode_pembayaran_jenis" => $request->input("jenis"),
            "metode_pembayaran_nama" => $request->input("nama"),
            "metode_pembayaran_nomor" => $request->input("nomor"),
        ];
        Metode_Pembayaran::create($data);
        Log::info(
            "🟢 Metode_Pembayaran " .
                $request->input("nama") .
                " berhasil ditambahkan"
        );
        return redirect()
            ->back()
            ->with("success", "Data metode_pembayaran berhasil ditambahkan!");
    }
    public function update(Request $request, $id)
    {
        $ids = Metode_Pembayaran::find($id);
        if (!$ids) {
            return redirect()
                ->back()
                ->with("error", "Data metode_pembayaran tidak ditemukan.");
        }
        $data = [
            "metode_pembayaran_id" => $id,
            "metode_pembayaran_user_id" => $request->input("user"),
            "metode_pembayaran_jenis" => $request->input("jenis"),
            "metode_pembayaran_nama" => $request->input("nama"),
            "metode_pembayaran_nomor" => $request->input("nomor"),
        ];
        $ids->update($data);
        Log::notice(
            "🟡 Metode_Pembayaran " .
                $request->input("nama") .
                " berhasil diubah"
        );
        return redirect()
            ->back()
            ->with("success", "Data metode_pembayaran berhasil diperbarui!");
    }
    public function delete($id)
    {
        $metode_pembayaran = Metode_Pembayaran::find($id);
        if ($metode_pembayaran) {
            Log::alert(
                "🔴 Metode_Pembayaran dengan ID : " . $id . " berhasil dihapus"
            );
            $metode_pembayaran->delete();
            return redirect()
                ->back()
                ->with("deleted", "Data metode_pembayaran berhasil dihapus!");
        } else {
            Log::error(
                "🔴 Metode_Pembayaran dengan ID : " . $id . " gagal dihapus"
            );
            return redirect()
                ->back()
                ->with("error", "Data metode_pembayaran tidak ditemukan.");
        }
    }
}
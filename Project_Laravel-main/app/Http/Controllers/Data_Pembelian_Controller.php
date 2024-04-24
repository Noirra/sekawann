<?php

namespace App\Http\Controllers;

use App\Models\Data_Pakaian;
use App\Models\Data_Pembelian;
use App\Models\Detail_Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class Data_Pembelian_Controller extends Controller
{
    public function createData_Pembelian()
    {
        return view("web.create.pembelian");
    }
    public function updateData_Pembelian($id)
    {
        $data = Data_Pembelian::readData_PembelianById($id);
        return view("web.update.pembelian", ["pembelian" => $data]);
    }
    public function create(Request $request)
    {
        $data = [
            "pembelian_user_id" => $request->input("user"),
            "pembelian_metode_pembayaran_id" => $request->input(
                "metode_pembayaran"
            ),
            "pembelian_tanggal" => $request->input("tanggal"),
            "pembelian_total_harga" => $request->input("total_harga"),
            "pembelian_status" => $request->input("status"),
        ];
        $pembelian = Data_Pembelian::create($data);

        $pakaian = $request->input("pakaian");
        $jumlah = $request->input("jumlah");
        $total = $request->input("total");

        foreach ($pakaian as $index => $pakaian_id) {
            $detailData = [
                "detail_pembelian_pembelian_id" => $pembelian->pembelian_id,
                "detail_pembelian_pakaian_id" => $pakaian_id,
                "detail_pembelian_jumlah" => $jumlah[$index],
                "detail_pembelian_total_harga" => $total[$index],
            ];

            Detail_Pembelian::create($detailData);

            $data_pakaian = Data_Pakaian::find($pakaian_id);
            if ($data_pakaian) {
                $data_pakaian->decrement("pakaian_stok", $jumlah[$index]);
            }
        }
        Session::forget("cart");
        Log::info(
            "🟢 Data_Pembelian " .
                $request->input("nama") .
                " berhasil ditambahkan"
        );
        return redirect()
            ->back()
            ->with("success", "Data pembelian berhasil ditambahkan!");
    }
    public function update(Request $request, $id)
    {
        $ids = Data_Pembelian::find($id);
        if (!$ids) {
            return redirect()
                ->route("pembelian")
                ->with("error", "Data pembelian tidak ditemukan.");
        }
        $data = [
            "pembelian_id" => $id,
            "pembelian_user_id" => $request->input("user"),
            "pembelian_metode_pembayaran_id" => $request->input(
                "metode_pembayaran"
            ),
            "pembelian_tanggal" => $request->input("tanggal"),
            "pembelian_total_harga" => $request->input("total_harga"),
            "pembelian_status" => $request->input("status"),
        ];
        $ids->update($data);
        Log::notice(
            "🟡 Data_Pembelian " . $request->input("nama") . " berhasil diubah"
        );
        return redirect()
            ->back()
            ->with("success", "Data pembelian berhasil diperbarui!");
    }
    public function delete($id)
    {
        $pembelian = Data_Pembelian::find($id);
        if ($pembelian) {
            Log::alert(
                "🔴 Data_Pembelian dengan ID : " . $id . " berhasil dihapus"
            );
            $pembelian->delete();
            return redirect()
                ->back()
                ->with("deleted", "Data pembelian berhasil dihapus!");
        } else {
            Log::error(
                "🔴 Data_Pembelian dengan ID : " . $id . " gagal dihapus"
            );
            return redirect()
                ->back()
                ->with("error", "Data pembelian tidak ditemukan.");
        }
    }
}
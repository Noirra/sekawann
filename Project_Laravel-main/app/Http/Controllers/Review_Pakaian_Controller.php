<?php

namespace App\Http\Controllers;

use App\Models\Review_Pakaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Review_Pakaian_Controller extends Controller
{
    public function createReview_Pakaian()
    {
        return view("web.create.review");
    }
    public function updateReview_Pakaian($id)
    {
        $data = Review_Pakaian::readReview_PakaianById($id);
        return view("web.update.review", ["review" => $data]);
    }
    public function create(Request $request)
    {
        $data = [
            "review_pakaian_id" => $request->input("pakaian"),
            "review_user_id" => $request->input("user"),
            "revies_rating" => $request->input("rating"),
            "review_note" => $request->input("note"),
        ];
        Review_Pakaian::create($data);
        Log::info(
            "🟢 Review_Pakaian " .
                $request->input("nama") .
                " berhasil ditambahkan"
        );
        return redirect()
            ->back()
            ->with("success", "Data review berhasil ditambahkan!");
    }
    public function update(Request $request, $id)
    {
        $ids = Review_Pakaian::find($id);
        if (!$ids) {
            return redirect()
                ->back()
                ->with("error", "Data review tidak ditemukan.");
        }
        $data = [
            "review_id" => $id,
            "review_pakaian_id" => $request->input("pakaian"),
            "review_user_id" => $request->input("user"),
            "revies_rating" => $request->input("rating"),
            "review_note" => $request->input("note"),
        ];
        $ids->update($data);
        Log::notice(
            "🟡 Review_Pakaian " . $request->input("nama") . " berhasil diubah"
        );
        return redirect()
            ->back()
            ->with("success", "Data review berhasil diperbarui!");
    }
    public function delete($id)
    {
        $review = Review_Pakaian::find($id);
        if ($review) {
            Log::alert(
                "🔴 Review_Pakaian dengan ID : " . $id . " berhasil dihapus"
            );
            $review->delete();
            return redirect()
                ->back()
                ->with("deleted", "Data review berhasil dihapus!");
        } else {
            Log::error(
                "🔴 Review_Pakaian dengan ID : " . $id . " gagal dihapus"
            );
            return redirect()
                ->back()
                ->with("error", "Data review tidak ditemukan.");
        }
    }
}
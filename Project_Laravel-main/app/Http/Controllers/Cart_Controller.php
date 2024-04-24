<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Cart_Controller extends Controller
{
    public function addToCart(Request $request)
    {
        $product = [
            "id" => $request->input("product_id"),
            "jumlah" => $request->input("product_jumlah"),
        ];

        $cart = Session::get("cart", []);
        $cart[] = $product;
        Session::put("cart", $cart);
        return redirect()
            ->back()
            ->with("success", "Pakaian ditambahkan ke Cart.");
    }

    public function removeFromCart(Request $request)
    {
        $productId = $request->input("product_id");
        $cart = Session::get("cart", []);
        $index = array_search($productId, array_column($cart, "id"));

        if ($index !== false) {
            unset($cart[$index]);
            $cart = array_values($cart);
            Session::put("cart", $cart);
            return redirect()
                ->back()
                ->with("success", "Pakaian dihapus dari ke Cart.");
        }

        return redirect()
            ->back()
            ->with("error", "Pakaian tidak ditemukan.");
    }
}
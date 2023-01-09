<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('landing/cart', [
            'page' => 'Keranjang',
            'Products' => Product::all(),
            'Carts' => Cart::all()
        ]);
    }

    public function store(Request $request, $product_id)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'quantity' => 'required'
        ]);

        $validated['product_id'] = $product_id;

        if(Cart::create($validated)){
            $request->session()->flash('status', 'Berhasil menambah barang ke dalam keranjang.');
            return back();
        }
    }

    public function destroy($id)
    {
        Cart::where('id', $id)->delete();
        return back()->with('success', 'Produk berhasil dihapus');
    }
}

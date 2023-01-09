<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $Products = Product::latest();
        if(request('search')){
            return view('landing/category', [
                "title" => "Search Result For: ".request('search'),
                "category" => "keyword '".request('search')."'",
                "Products" => Product::latest()->filter(request(['search']))->get()
            ]);
        }
        return view('landing/home', [
            "Products" => $Products->limit(6)->get(),
            'Carts' => Cart::all()
        ]);
    }
}

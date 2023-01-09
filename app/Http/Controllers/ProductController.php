<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return view('landing/product', [
            'Product' => Product::firstWhere('id', $id),
            'Products' => Product::all(),
            'Images' => ProductImage::all(),
            'startFrom1' => 2,
            'startFrom2' => 2,
            "RelatedProducts" => Product::inRandomOrder()->get(),
            'Carts' => Cart::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('landing/product/upload', [
            'Categories' => Category::all(),
            'Carts' => Cart::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'type' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
            'description' => 'required'
        ]);

        $request->validate([
            'files' => 'required',
            'files.*' => 'image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);
        
        $files = [];
        $indexStart = 1;
        if($request->file('files')) {
            foreach($request->file('files') as $key => $file) {
                $fileName = $file->store('uploads');
                $files[]['url'] = $fileName;
            }
        }

        $Product = Product::create($validated);

        if($Product) {
            foreach ($files as $key => $file) {
                $file['product_id'] = $Product->id;
                $file['index'] = $indexStart++;
                ProductImage::create($file);
            }            

            return redirect('/dashboard')->with('success', 'Produk baru berhasil ditambahkan');
        }else {
            return back()->with('ErrorStore', 'Produk gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('landing/product/update', [
            'Product' => Product::firstWhere('id', $id),
            'Products' => Product::all(),
            'Categories' => Category::all(),
            'Carts' => Cart::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'type' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
            'description' => 'required'
        ]);

        if(Product::where('id', $id)->update($validated)){
            return redirect('/dashboard')->with('success', 'Perubahan berhasil disimpan');
        }else {
            return back()->with('ErrorStore', 'Perubahan gagal disimpan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductImage::where('product_id', $id)->delete();
        Product::where('id', $id)->delete();
        return redirect('/dashboard')->with('success', 'Produk berhasil dihapus');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}

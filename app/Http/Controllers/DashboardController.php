<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('landing/dashboard', [
            'page' => 'Beranda',
            'Products' => Product::all(),
            'Carts' => Cart::all()
        ]);
    }

    public function profile()
    {
        return view('landing/profile', [
            'page' => 'Profil',
            'Carts' => Cart::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|max:255',
            'city' => 'max:255',
            'province' => 'max:255',
            'photo' => 'image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);

        $validated['city'] = ucwords($validated['city']);
        $validated['province'] = ucwords($validated['province']);

        if($request->file('photo')){
            $validated['photo'] = $request->file('photo')->store('uploads/photo');
        }

        if(User::where('id', $request->id)->update($validated)){
            return redirect('/dashboard/profile')->with('success', 'Perubahan berhasil disimpan');
        }else {
            return back()->with('ErrorStore', 'Perubahan gagal disimpan');
        }
    }
}

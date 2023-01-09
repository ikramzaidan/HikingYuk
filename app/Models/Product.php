<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function firstImage($id)
    {
        return DB::table('product_images')->where('product_id', $id)->where('index', 1)->first();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Core\Database\Model;
use  \Core\Database\QueryBuilder;
class Products extends Model
{
    protected static string $table      = 'products';
    protected static string $primaryKey = 'id';
    protected static bool   $timestamps = false;

    protected static array $fillable = [];
    protected static array $guarded  = ['id'];

    // Products has many ProductImage rows, linked via product_id on productimages
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
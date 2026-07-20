<?php

namespace App\Models;

use Core\Database\Model;

class ProductImage extends Model
{
    protected static string $table      = 'product_images';
    protected static string $primaryKey = 'id';
    protected static bool   $timestamps = false;

    protected static array $fillable = [];
    protected static array $guarded  = ['id'];

    // Inverse: each image belongs to a Product
    public function product(): ?object
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
   
}
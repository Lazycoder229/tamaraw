<?php

namespace App\Models;

use Core\Database\Model;

class Cart_Items extends Model
{
    protected static string $table      = 'cart_itemses';
    protected static string $primaryKey = 'id';
    protected static bool   $timestamps = false;

    protected static array $fillable = [];

    protected static array $guarded = ['id'];
}
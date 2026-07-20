<?php

namespace App\Models;

use Core\Database\Model;

class Order_Items extends Model
{
    protected static string $table      = 'order_itemses';
    protected static string $primaryKey = 'id';
    protected static bool   $timestamps = false;

    protected static array $fillable = [];

    protected static array $guarded = ['id'];
}
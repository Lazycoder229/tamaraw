<?php

namespace App\Models;

use Core\Database\Model;

class Orders extends Model
{
    protected static string $table      = 'orderses';
    protected static string $primaryKey = 'id';
    protected static bool   $timestamps = false;

    protected static array $fillable = [];

    protected static array $guarded = ['id'];
}
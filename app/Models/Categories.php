<?php

namespace App\Models;

use Core\Database\Model;

class Categories extends Model
{
    protected static string $table      = 'categories';
    protected static string $primaryKey = 'id';
    protected static bool   $timestamps = false;

    protected static array $fillable = [];

    protected static array $guarded = ['id'];
}
<?php

namespace App\Models;

use Core\Database\Model;

class Reviews extends Model
{
    protected static string $table      = 'reviewses';
    protected static string $primaryKey = 'id';
    protected static bool   $timestamps = false;

    protected static array $fillable = [];

    protected static array $guarded = ['id'];
}
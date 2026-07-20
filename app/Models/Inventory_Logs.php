<?php

namespace App\Models;

use Core\Database\Model;

class Inventory_Logs extends Model
{
    protected static string $table      = 'inventory_logses';
    protected static string $primaryKey = 'id';
    protected static bool   $timestamps = false;

    protected static array $fillable = [];

    protected static array $guarded = ['id'];
}
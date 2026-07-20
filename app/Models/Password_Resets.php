<?php

namespace App\Models;

use Core\Database\Model;

class Password_Resets extends Model
{
    protected static string $table      = 'password_resetses';
    protected static string $primaryKey = 'id';
    protected static bool   $timestamps = false;

    protected static array $fillable = [];

    protected static array $guarded = ['id'];
}
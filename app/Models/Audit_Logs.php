<?php

namespace App\Models;

use Core\Database\Model;

class Audit_Logs extends Model
{
    protected static string $table      = 'audit_logses';
    protected static string $primaryKey = 'id';
    protected static bool   $timestamps = false;

    protected static array $fillable = [];

    protected static array $guarded = ['id'];
}
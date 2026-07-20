<?php

namespace App\Models;

use Core\Database\Model;

class Ai_Chat_Sessions extends Model
{
    protected static string $table      = 'ai_chat_sessionses';
    protected static string $primaryKey = 'id';
    protected static bool   $timestamps = false;

    protected static array $fillable = [];

    protected static array $guarded = ['id'];
}
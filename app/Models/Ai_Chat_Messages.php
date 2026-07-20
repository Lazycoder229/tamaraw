<?php

namespace App\Models;

use Core\Database\Model;

class Ai_Chat_Messages extends Model
{
    protected static string $table      = 'ai_chat_messageses';
    protected static string $primaryKey = 'id';
    protected static bool   $timestamps = false;

    protected static array $fillable = [];

    protected static array $guarded = ['id'];
}
<?php

namespace App\Models;

use Core\Database\Model;

class Users extends Model
{
    protected static string $table      = 'users';
    protected static string $primaryKey = 'id';
    protected static bool   $timestamps = true;

    protected static array $fillable = ['role','first_name','last_name','email','phone_number','password_hash','profile_photo','status'];

    protected static array $guarded = ['id'];
}
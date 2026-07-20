<?php

namespace App\Models;

use Core\Database\Model;

class Order_Status_Logs extends Model
{
    protected static string $table      = 'order_status_logses';
    protected static string $primaryKey = 'id';
    protected static bool   $timestamps = false;

    protected static array $fillable = [];

    protected static array $guarded = ['id'];
}
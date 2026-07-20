<?php

namespace App\Models;

use Core\Database\Model;

class Farmer_Profiles extends Model
{
    protected static string $table      = 'farmer_profiles';
    protected static string $primaryKey = 'id';
    protected static bool   $timestamps = true; // may created_at/updated_at ang table mo

    protected static array $fillable = [
        'user_id',
        'farm_name',
        'farm_description',
        'farm_barangay',
        'store_open',
        'delivery_available',
        'pickup_available',
    ];

    protected static array $guarded = [
        'id',
        'verification_status', // system-controlled — admin lang dapat nagpapalit nito
        'rating_avg',           // computed mula sa reviews, hindi direktang input
        'rating_count',         // computed din
    ];

    public function user(): ?object
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
}
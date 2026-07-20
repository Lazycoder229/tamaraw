<?php

namespace App\Models;

use Core\Database\Model;

class Farmer_Verication_Documents extends Model
{
    protected static string $table      = 'farmer_verication_documentses';
    protected static string $primaryKey = 'id';
    protected static bool   $timestamps = false;

    protected static array $fillable = [];

    protected static array $guarded = ['id'];

    public function farmerProfile(): ?object
{
    return $this->belongsTo(Farmer_Profiles::class, 'farmer_id');
}

public function reviewer(): ?object
{
    return $this->belongsTo(Users::class, 'reviewed_by');
}
}
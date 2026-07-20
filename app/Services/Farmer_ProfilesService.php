<?php

namespace App\Services;

use App\Models\Farmer_Profiles;

class Farmer_ProfilesService
{
    // ── Get all ───────────────────────────────────────────────────────────────
    public function all(): array
    {
        return Farmer_Profiles::all();
    }
    public function count(): int
    {
        return Farmer_Profiles::count();
    }
    // ── Find by ID ────────────────────────────────────────────────────────────
    public function find(int|string $id): mixed
    {
        return Farmer_Profiles::findOrFail($id);
    }

    // ── Create ────────────────────────────────────────────────────────────────
    public function create(array $data): Farmer_Profiles
    {
        return Farmer_Profiles::create($data);
    }

    // ── Update ────────────────────────────────────────────────────────────────
    public function update(int|string $id, array $data): bool
    {
        $record = Farmer_Profiles::findOrFail($id);
        return $record->update($data);
    }

    // ── Delete ────────────────────────────────────────────────────────────────
    public function delete(int|string $id): bool
    {
        $record = Farmer_Profiles::findOrFail($id);
        return $record->delete();
    }
}
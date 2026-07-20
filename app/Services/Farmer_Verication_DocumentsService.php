<?php

namespace App\Services;

use App\Models\Farmer_Verication_Documents;

class Farmer_Verication_DocumentsService
{
    // ── Get all ───────────────────────────────────────────────────────────────
    public function all(): array
    {
        return Farmer_Verication_Documents::all();
    }

    // ── Find by ID ────────────────────────────────────────────────────────────
    public function find(int|string $id): mixed
    {
        return Farmer_Verication_Documents::findOrFail($id);
    }

    // ── Create ────────────────────────────────────────────────────────────────
    public function create(array $data): Farmer_Verication_Documents
    {
        return Farmer_Verication_Documents::create($data);
    }

    // ── Update ────────────────────────────────────────────────────────────────
    public function update(int|string $id, array $data): bool
    {
        $record = Farmer_Verication_Documents::findOrFail($id);
        return $record->update($data);
    }

    // ── Delete ────────────────────────────────────────────────────────────────
    public function delete(int|string $id): bool
    {
        $record = Farmer_Verication_Documents::findOrFail($id);
        return $record->delete();
    }
}
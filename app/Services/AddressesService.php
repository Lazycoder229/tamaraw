<?php

namespace App\Services;

use App\Models\Addresses;

class AddressesService
{
    // ── Get all ───────────────────────────────────────────────────────────────
    public function all(): array
    {
        return Addresses::all();
    }

    // ── Find by ID ────────────────────────────────────────────────────────────
    public function find(int|string $id): mixed
    {
        return Addresses::findOrFail($id);
    }

    // ── Create ────────────────────────────────────────────────────────────────
    public function create(array $data): Addresses
    {
        return Addresses::create($data);
    }

    // ── Update ────────────────────────────────────────────────────────────────
    public function update(int|string $id, array $data): bool
    {
        $record = Addresses::findOrFail($id);
        return $record->update($data);
    }

    // ── Delete ────────────────────────────────────────────────────────────────
    public function delete(int|string $id): bool
    {
        $record = Addresses::findOrFail($id);
        return $record->delete();
    }
}
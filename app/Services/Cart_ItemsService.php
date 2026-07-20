<?php

namespace App\Services;

use App\Models\Cart_Items;

class Cart_ItemsService
{
    // ── Get all ───────────────────────────────────────────────────────────────
    public function all(): array
    {
        return Cart_Items::all();
    }

    // ── Find by ID ────────────────────────────────────────────────────────────
    public function find(int|string $id): mixed
    {
        return Cart_Items::findOrFail($id);
    }

    // ── Create ────────────────────────────────────────────────────────────────
    public function create(array $data): Cart_Items
    {
        return Cart_Items::create($data);
    }

    // ── Update ────────────────────────────────────────────────────────────────
    public function update(int|string $id, array $data): bool
    {
        $record = Cart_Items::findOrFail($id);
        return $record->update($data);
    }

    // ── Delete ────────────────────────────────────────────────────────────────
    public function delete(int|string $id): bool
    {
        $record = Cart_Items::findOrFail($id);
        return $record->delete();
    }
}
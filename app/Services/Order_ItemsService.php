<?php

namespace App\Services;

use App\Models\Order_Items;

class Order_ItemsService
{
    // ── Get all ───────────────────────────────────────────────────────────────
    public function all(): array
    {
        return Order_Items::all();
    }

    // ── Find by ID ────────────────────────────────────────────────────────────
    public function find(int|string $id): mixed
    {
        return Order_Items::findOrFail($id);
    }

    // ── Create ────────────────────────────────────────────────────────────────
    public function create(array $data): Order_Items
    {
        return Order_Items::create($data);
    }

    // ── Update ────────────────────────────────────────────────────────────────
    public function update(int|string $id, array $data): bool
    {
        $record = Order_Items::findOrFail($id);
        return $record->update($data);
    }

    // ── Delete ────────────────────────────────────────────────────────────────
    public function delete(int|string $id): bool
    {
        $record = Order_Items::findOrFail($id);
        return $record->delete();
    }
}
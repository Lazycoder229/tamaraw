<?php

namespace App\Services;

use App\Models\Orders;

class OrdersService
{
    // ── Get all ───────────────────────────────────────────────────────────────
    public function all(): array
    {
        return Orders::all();
    }

    // ── Find by ID ────────────────────────────────────────────────────────────
    public function find(int|string $id): mixed
    {
        return Orders::findOrFail($id);
    }

    // ── Create ────────────────────────────────────────────────────────────────
    public function create(array $data): Orders
    {
        return Orders::create($data);
    }

    // ── Update ────────────────────────────────────────────────────────────────
    public function update(int|string $id, array $data): bool
    {
        $record = Orders::findOrFail($id);
        return $record->update($data);
    }

    // ── Delete ────────────────────────────────────────────────────────────────
    public function delete(int|string $id): bool
    {
        $record = Orders::findOrFail($id);
        return $record->delete();
    }
}
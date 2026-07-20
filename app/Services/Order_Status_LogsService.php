<?php

namespace App\Services;

use App\Models\Order_Status_Logs;

class Order_Status_LogsService
{
    // ── Get all ───────────────────────────────────────────────────────────────
    public function all(): array
    {
        return Order_Status_Logs::all();
    }

    // ── Find by ID ────────────────────────────────────────────────────────────
    public function find(int|string $id): mixed
    {
        return Order_Status_Logs::findOrFail($id);
    }

    // ── Create ────────────────────────────────────────────────────────────────
    public function create(array $data): Order_Status_Logs
    {
        return Order_Status_Logs::create($data);
    }

    // ── Update ────────────────────────────────────────────────────────────────
    public function update(int|string $id, array $data): bool
    {
        $record = Order_Status_Logs::findOrFail($id);
        return $record->update($data);
    }

    // ── Delete ────────────────────────────────────────────────────────────────
    public function delete(int|string $id): bool
    {
        $record = Order_Status_Logs::findOrFail($id);
        return $record->delete();
    }
}
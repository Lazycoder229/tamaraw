<?php

namespace App\Services;

use App\Models\Inventory_Logs;

class Inventory_LogsService
{
    // ── Get all ───────────────────────────────────────────────────────────────
    public function all(): array
    {
        return Inventory_Logs::all();
    }

    // ── Find by ID ────────────────────────────────────────────────────────────
    public function find(int|string $id): mixed
    {
        return Inventory_Logs::findOrFail($id);
    }

    // ── Create ────────────────────────────────────────────────────────────────
    public function create(array $data): Inventory_Logs
    {
        return Inventory_Logs::create($data);
    }

    // ── Update ────────────────────────────────────────────────────────────────
    public function update(int|string $id, array $data): bool
    {
        $record = Inventory_Logs::findOrFail($id);
        return $record->update($data);
    }

    // ── Delete ────────────────────────────────────────────────────────────────
    public function delete(int|string $id): bool
    {
        $record = Inventory_Logs::findOrFail($id);
        return $record->delete();
    }
}
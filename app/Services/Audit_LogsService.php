<?php

namespace App\Services;

use App\Models\Audit_Logs;

class Audit_LogsService
{
    // ── Get all ───────────────────────────────────────────────────────────────
    public function all(): array
    {
        return Audit_Logs::all();
    }

    // ── Find by ID ────────────────────────────────────────────────────────────
    public function find(int|string $id): mixed
    {
        return Audit_Logs::findOrFail($id);
    }

    // ── Create ────────────────────────────────────────────────────────────────
    public function create(array $data): Audit_Logs
    {
        return Audit_Logs::create($data);
    }

    // ── Update ────────────────────────────────────────────────────────────────
    public function update(int|string $id, array $data): bool
    {
        $record = Audit_Logs::findOrFail($id);
        return $record->update($data);
    }

    // ── Delete ────────────────────────────────────────────────────────────────
    public function delete(int|string $id): bool
    {
        $record = Audit_Logs::findOrFail($id);
        return $record->delete();
    }
}
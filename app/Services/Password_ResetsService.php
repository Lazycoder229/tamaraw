<?php

namespace App\Services;

use App\Models\Password_Resets;

class Password_ResetsService
{
    // ── Get all ───────────────────────────────────────────────────────────────
    public function all(): array
    {
        return Password_Resets::all();
    }

    // ── Find by ID ────────────────────────────────────────────────────────────
    public function find(int|string $id): mixed
    {
        return Password_Resets::findOrFail($id);
    }

    // ── Create ────────────────────────────────────────────────────────────────
    public function create(array $data): Password_Resets
    {
        return Password_Resets::create($data);
    }

    // ── Update ────────────────────────────────────────────────────────────────
    public function update(int|string $id, array $data): bool
    {
        $record = Password_Resets::findOrFail($id);
        return $record->update($data);
    }

    // ── Delete ────────────────────────────────────────────────────────────────
    public function delete(int|string $id): bool
    {
        $record = Password_Resets::findOrFail($id);
        return $record->delete();
    }
}
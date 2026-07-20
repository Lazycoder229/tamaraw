<?php

namespace App\Services;

use App\Models\Ai_Chat_Sessions;

class Ai_Chat_SessionsService
{
    // ── Get all ───────────────────────────────────────────────────────────────
    public function all(): array
    {
        return Ai_Chat_Sessions::all();
    }

    // ── Find by ID ────────────────────────────────────────────────────────────
    public function find(int|string $id): mixed
    {
        return Ai_Chat_Sessions::findOrFail($id);
    }

    // ── Create ────────────────────────────────────────────────────────────────
    public function create(array $data): Ai_Chat_Sessions
    {
        return Ai_Chat_Sessions::create($data);
    }

    // ── Update ────────────────────────────────────────────────────────────────
    public function update(int|string $id, array $data): bool
    {
        $record = Ai_Chat_Sessions::findOrFail($id);
        return $record->update($data);
    }

    // ── Delete ────────────────────────────────────────────────────────────────
    public function delete(int|string $id): bool
    {
        $record = Ai_Chat_Sessions::findOrFail($id);
        return $record->delete();
    }
}
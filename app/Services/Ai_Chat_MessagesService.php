<?php

namespace App\Services;

use App\Models\Ai_Chat_Messages;

class Ai_Chat_MessagesService
{
    // ── Get all ───────────────────────────────────────────────────────────────
    public function all(): array
    {
        return Ai_Chat_Messages::all();
    }

    // ── Find by ID ────────────────────────────────────────────────────────────
    public function find(int|string $id): mixed
    {
        return Ai_Chat_Messages::findOrFail($id);
    }

    // ── Create ────────────────────────────────────────────────────────────────
    public function create(array $data): Ai_Chat_Messages
    {
        return Ai_Chat_Messages::create($data);
    }

    // ── Update ────────────────────────────────────────────────────────────────
    public function update(int|string $id, array $data): bool
    {
        $record = Ai_Chat_Messages::findOrFail($id);
        return $record->update($data);
    }

    // ── Delete ────────────────────────────────────────────────────────────────
    public function delete(int|string $id): bool
    {
        $record = Ai_Chat_Messages::findOrFail($id);
        return $record->delete();
    }
}
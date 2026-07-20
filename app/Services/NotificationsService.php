<?php

namespace App\Services;

use App\Models\Notifications;

class NotificationsService
{
    // ── Get all ───────────────────────────────────────────────────────────────
    public function all(): array
    {
        return Notifications::all();
    }

    // ── Find by ID ────────────────────────────────────────────────────────────
    public function find(int|string $id): mixed
    {
        return Notifications::findOrFail($id);
    }

    // ── Create ────────────────────────────────────────────────────────────────
    public function create(array $data): Notifications
    {
        return Notifications::create($data);
    }

    // ── Update ────────────────────────────────────────────────────────────────
    public function update(int|string $id, array $data): bool
    {
        $record = Notifications::findOrFail($id);
        return $record->update($data);
    }

    // ── Delete ────────────────────────────────────────────────────────────────
    public function delete(int|string $id): bool
    {
        $record = Notifications::findOrFail($id);
        return $record->delete();
    }
}
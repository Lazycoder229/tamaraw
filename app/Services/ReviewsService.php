<?php

namespace App\Services;

use App\Models\Reviews;

class ReviewsService
{
    // ── Get all ───────────────────────────────────────────────────────────────
    public function all(): array
    {
        return Reviews::all();
    }

    // ── Find by ID ────────────────────────────────────────────────────────────
    public function find(int|string $id): mixed
    {
        return Reviews::findOrFail($id);
    }

    // ── Create ────────────────────────────────────────────────────────────────
    public function create(array $data): Reviews
    {
        return Reviews::create($data);
    }

    // ── Update ────────────────────────────────────────────────────────────────
    public function update(int|string $id, array $data): bool
    {
        $record = Reviews::findOrFail($id);
        return $record->update($data);
    }

    // ── Delete ────────────────────────────────────────────────────────────────
    public function delete(int|string $id): bool
    {
        $record = Reviews::findOrFail($id);
        return $record->delete();
    }
}
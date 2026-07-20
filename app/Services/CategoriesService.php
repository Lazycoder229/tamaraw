<?php

namespace App\Services;

use App\Models\Categories;

class CategoriesService
{
    // ── Get all ───────────────────────────────────────────────────────────────
    public function all(): array
    {
        return Categories::all();
    }

    // ── Find by ID ────────────────────────────────────────────────────────────
    public function find(int|string $id): mixed
    {
        return Categories::findOrFail($id);
    }

    // ── Create ────────────────────────────────────────────────────────────────
    public function create(array $data): Categories
    {
        return Categories::create($data);
    }

    // ── Update ────────────────────────────────────────────────────────────────
    public function update(int|string $id, array $data): bool
    {
        $record = Categories::findOrFail($id);
        return $record->update($data);
    }

    // ── Delete ────────────────────────────────────────────────────────────────
    public function delete(int|string $id): bool
    {
        $record = Categories::findOrFail($id);
        return $record->delete();
    }
}
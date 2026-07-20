<?php

namespace App\Services;

use App\Models\Payments;

class PaymentsService
{
    // ── Get all ───────────────────────────────────────────────────────────────
    public function all(): array
    {
        return Payments::all();
    }

    // ── Find by ID ────────────────────────────────────────────────────────────
    public function find(int|string $id): mixed
    {
        return Payments::findOrFail($id);
    }

    // ── Create ────────────────────────────────────────────────────────────────
    public function create(array $data): Payments
    {
        return Payments::create($data);
    }

    // ── Update ────────────────────────────────────────────────────────────────
    public function update(int|string $id, array $data): bool
    {
        $record = Payments::findOrFail($id);
        return $record->update($data);
    }

    // ── Delete ────────────────────────────────────────────────────────────────
    public function delete(int|string $id): bool
    {
        $record = Payments::findOrFail($id);
        return $record->delete();
    }
}
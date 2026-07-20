<?php

namespace App\Services;

use App\Models\Cart;

class CartService
{
    // ── Get all ───────────────────────────────────────────────────────────────
    public function all(): array
    {
        return Cart::all();
    }

    // ── Find by ID ────────────────────────────────────────────────────────────
    public function find(int|string $id): mixed
    {
        return Cart::findOrFail($id);
    }

    // ── Create ────────────────────────────────────────────────────────────────
    public function create(array $data): Cart
    {
        return Cart::create($data);
    }

    // ── Update ────────────────────────────────────────────────────────────────
    public function update(int|string $id, array $data): bool
    {
        $record = Cart::findOrFail($id);
        return $record->update($data);
    }

    // ── Delete ────────────────────────────────────────────────────────────────
    public function delete(int|string $id): bool
    {
        $record = Cart::findOrFail($id);
        return $record->delete();
    }
}
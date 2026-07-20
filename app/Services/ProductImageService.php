<?php

namespace App\Services;

use App\Models\ProductImage;

class ProductImageService
{
    // ── Get all ───────────────────────────────────────────────────────────────
    public function all(): array
    {
        return ProductImage::all();
    }

    // ── Find by ID ────────────────────────────────────────────────────────────
    public function find(int|string $id): mixed
    {
        return ProductImage::findOrFail($id);
    }

    // ── Create ────────────────────────────────────────────────────────────────
    public function create(array $data): ProductImage
    {
        return ProductImage::create($data);
    }

    // ── Update ────────────────────────────────────────────────────────────────
    public function update(int|string $id, array $data): bool
    {
        $record = ProductImage::findOrFail($id);
        return $record->update($data);
    }

    // ── Delete ────────────────────────────────────────────────────────────────
    public function delete(int|string $id): bool
    {
        $record = ProductImage::findOrFail($id);
        return $record->delete();
    }
}
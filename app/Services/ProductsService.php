<?php

namespace App\Services;

use App\Models\Products;

class ProductsService
{
    // ── Get all ───────────────────────────────────────────────────────────────
    public function all(): array
    {
        return Products::all();
    }
    // ProductsService
    public function count(): int
    {
        return Products::count();
    }
   
   public function allWithImages(): array
{
    $products = Products::with('images', 'category')->get();

    foreach ($products as $product) {
        $firstImage = $product->images[0] ?? null;
        $product->imagePath = $firstImage->file_path ?? null;

        $product->categoryName = $product->category->name ?? null;
        $product->categorySlug = $product->category->slug ?? null;
    }

    return $products;
}
    // ── Find by ID ────────────────────────────────────────────────────────────
    public function find(int|string $id): mixed
    {
        return Products::findOrFail($id);
    }

    // ── Create ────────────────────────────────────────────────────────────────
    public function create(array $data): Products
    {
        return Products::create($data);
    }

    // ── Update ────────────────────────────────────────────────────────────────
    public function update(int|string $id, array $data): bool
    {
        $record = Products::findOrFail($id);
        return $record->update($data);
    }

    // ── Delete ────────────────────────────────────────────────────────────────
    public function delete(int|string $id): bool
    {
        $record = Products::findOrFail($id);
        return $record->delete();
    }
}
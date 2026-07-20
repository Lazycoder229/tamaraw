<?php
declare(strict_types=1);

use Core\Database\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->schemaCreate('cart_items', function ($table) {
            $table->id();
            $table->foreignId('cart_id')->constrained('carts');
            $table->foreignId('product_id')->constrained('products');
            $table->integer('quantity', true);
            $table->timestamp('added_at');
        });

        // NOTE: integer() already bakes in "DEFAULT 0". Chaining ->default(1)
        // here would emit two DEFAULT clauses in the same column definition
        // (invalid SQL), so the real default is set via MODIFY instead.
        $this->db->query(
            "ALTER TABLE `cart_items` MODIFY `quantity` INT UNSIGNED NOT NULL DEFAULT 1"
        );
        $this->db->query(
            "ALTER TABLE `cart_items` MODIFY `added_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP"
        );

        // A product should only appear once per cart — re-adding it should
        // bump the quantity, not create a duplicate row.
        $this->db->query(
            'ALTER TABLE `cart_items` ADD UNIQUE KEY `uq_cart_product` (`cart_id`, `product_id`)'
        );
    }

    public function down(): void
    {
        $this->dropTable('cart_items');
    }
};

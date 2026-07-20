<?php
declare(strict_types=1);

use Core\Database\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->schemaCreate('order_items', function ($table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('product_id');
            $table->string('product_name', 150);   // snapshot at time of order
            $table->decimal('unit_price', 10, 2);   // snapshot at time of order
            $table->integer('quantity', true);
            $table->decimal('line_total', 10, 2);
        });

        // No ON DELETE clause on product_id: a product must not be deletable
        // while it's referenced by a historical order line.
        $this->addColumn(
            'order_items',
            'CONSTRAINT `fk_order_items_product_id` FOREIGN KEY (`product_id`) REFERENCES `products`(`id`)'
        );
    }

    public function down(): void
    {
        $this->dropTable('order_items');
    }
};

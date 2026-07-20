<?php
declare(strict_types=1);

use Core\Database\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->schemaCreate('orders', function ($table) {
            $table->id();
            $table->string('order_reference', 30)->unique();
            $table->foreignId('buyer_id');
            $table->foreignId('farmer_id');
            $table->foreignId('address_id');
            $table->enum('fulfillment_method', ['delivery', 'pickup']);
            $table->decimal('subtotal', 10, 2);
            $table->decimal('delivery_fee', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->enum('order_status', [
                'pending', 'confirmed', 'preparing', 'ready',
                'shipped', 'completed', 'cancelled',
            ])->default('pending');
            $table->enum('payment_status', ['unpaid', 'paid', 'refunded'])->default('unpaid');
            $table->timestamp('placed_at');
            $table->timestamps();
        });

        // buyer_id / farmer_id / address_id intentionally have no ON DELETE
        // clause (defaults to RESTRICT): historical orders must not be
        // silently deleted or orphaned just because a user or address record
        // is removed. Deletion of those should go through soft-deletes at
        // the application layer instead.
        $this->addColumn('orders', 'CONSTRAINT `fk_orders_buyer_id` FOREIGN KEY (`buyer_id`) REFERENCES `users`(`id`)');
        $this->addColumn('orders', 'CONSTRAINT `fk_orders_farmer_id` FOREIGN KEY (`farmer_id`) REFERENCES `farmer_profiles`(`id`)');
        $this->addColumn('orders', 'CONSTRAINT `fk_orders_address_id` FOREIGN KEY (`address_id`) REFERENCES `addresses`(`id`)');

        $this->db->query(
            "ALTER TABLE `orders` MODIFY `placed_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP"
        );

        // Seller Center + buyer order-tracking both filter heavily by status.
        $this->db->query('CREATE INDEX `idx_orders_buyer_status` ON `orders` (`buyer_id`, `order_status`)');
        $this->db->query('CREATE INDEX `idx_orders_farmer_status` ON `orders` (`farmer_id`, `order_status`)');
    }

    public function down(): void
    {
        $this->dropTable('orders');
    }
};

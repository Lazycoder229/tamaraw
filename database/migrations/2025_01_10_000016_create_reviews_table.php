<?php
declare(strict_types=1);

use Core\Database\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->schemaCreate('reviews', function ($table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('buyer_id');
            $table->foreignId('farmer_id');
            $table->foreignId('product_id')->nullable();
            $table->tinyInteger('rating');
            $table->text('comment')->nullable();
            $table->text('seller_reply')->nullable();
            $table->timestamp('created_at');
        });

        $this->addColumn('reviews', 'CONSTRAINT `fk_reviews_buyer_id` FOREIGN KEY (`buyer_id`) REFERENCES `users`(`id`)');
        $this->addColumn('reviews', 'CONSTRAINT `fk_reviews_farmer_id` FOREIGN KEY (`farmer_id`) REFERENCES `farmer_profiles`(`id`)');
        $this->addColumn(
            'reviews',
            'CONSTRAINT `fk_reviews_product_id` FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE SET NULL'
        );

        $this->db->query(
            "ALTER TABLE `reviews` MODIFY `rating` TINYINT UNSIGNED NOT NULL"
        );
        $this->db->query(
            "ALTER TABLE `reviews` MODIFY `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP"
        );

        // One review per product per order — stops a buyer from reviewing
        // the same line item twice. NULL product_id (order-level review)
        // is exempt since MySQL unique indexes allow multiple NULLs.
        $this->db->query(
            'ALTER TABLE `reviews` ADD UNIQUE KEY `uq_review_order_product` (`order_id`, `product_id`)'
        );
    }

    public function down(): void
    {
        $this->dropTable('reviews');
    }
};

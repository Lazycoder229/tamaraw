<?php
declare(strict_types=1);

use Core\Database\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->schemaCreate('products', function ($table) {
            $table->id();
            $table->foreignId('farmer_id')->constrained('farmer_profiles');
            $table->foreignId('category_id');
            $table->string('name', 150);
            $table->string('slug', 180)->unique();
            $table->text('description')->nullable();
            $table->enum('unit', ['kg', 'sack', 'piece', 'bundle', 'liter', 'tray']);
            $table->decimal('price', 10, 2);
            $table->integer('stock_quantity', true);
            $table->date('harvest_date');
            $table->enum('status', ['active', 'out_of_stock', 'archived'])->default('active');
            $table->timestamps();
        });

        // category_id intentionally has no ON DELETE clause (defaults to
        // RESTRICT): an Admin should not be able to delete a category that
        // still has products in it.
        $this->addColumn(
            'products',
            'CONSTRAINT `fk_products_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`)'
        );

        // Composite index to speed up the marketplace's
        // "browse by category + only show active" query.
        $this->db->query(
            'CREATE INDEX `idx_products_category_status` ON `products` (`category_id`, `status`)'
        );
    }

    public function down(): void
    {
        $this->dropTable('products');
    }
};

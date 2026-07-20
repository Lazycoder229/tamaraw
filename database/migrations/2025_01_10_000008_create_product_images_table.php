<?php
declare(strict_types=1);

use Core\Database\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->schemaCreate('product_images', function ($table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->string('file_path', 255);
            $table->boolean('is_primary');
            $table->integer('sort_order', true);
        });
    }

    public function down(): void
    {
        $this->dropTable('product_images');
    }
};

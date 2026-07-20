<?php
declare(strict_types=1);

use Core\Database\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->schemaCreate('categories', function ($table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('slug', 100)->unique();
            $table->foreignId('parent_id')->nullable();
        });

        // Self-referencing FK for subcategories. SET NULL so deleting a
        // parent category demotes its children to top-level instead of
        // cascading deletes through the whole category tree.
        $this->addColumn(
            'categories',
            'CONSTRAINT `fk_categories_parent_id` FOREIGN KEY (`parent_id`) REFERENCES `categories`(`id`) ON DELETE SET NULL'
        );
    }

    public function down(): void
    {
        $this->dropTable('categories');
    }
};

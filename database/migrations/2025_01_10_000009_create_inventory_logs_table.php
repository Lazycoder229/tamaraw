<?php
declare(strict_types=1);

use Core\Database\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->schemaCreate('inventory_logs', function ($table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->enum('change_type', ['restock', 'sale', 'manual_adjustment']);
            $table->integer('quantity_change');   // signed: can be negative
            $table->integer('resulting_stock', true);
            $table->string('note', 255)->nullable();
            $table->foreignId('created_by')->nullable();
            $table->timestamp('created_at');
        });

        $this->addColumn(
            'inventory_logs',
            'CONSTRAINT `fk_inventory_logs_created_by` FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE SET NULL'
        );

        // Blueprint::default() quotes every value as a string literal, which
        // would turn CURRENT_TIMESTAMP into the literal text 'CURRENT_TIMESTAMP'.
        // Set the real auto-timestamp default directly instead.
        $this->db->query(
            "ALTER TABLE `inventory_logs` MODIFY `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP"
        );
    }

    public function down(): void
    {
        $this->dropTable('inventory_logs');
    }
};

<?php
declare(strict_types=1);

use Core\Database\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->schemaCreate('order_status_logs', function ($table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders');
            $table->string('old_status', 30)->nullable();
            $table->string('new_status', 30);
            $table->foreignId('changed_by')->nullable();
            $table->timestamp('changed_at');
        });

        $this->addColumn(
            'order_status_logs',
            'CONSTRAINT `fk_order_status_logs_changed_by` FOREIGN KEY (`changed_by`) REFERENCES `users`(`id`) ON DELETE SET NULL'
        );

        $this->db->query(
            "ALTER TABLE `order_status_logs` MODIFY `changed_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP"
        );
    }

    public function down(): void
    {
        $this->dropTable('order_status_logs');
    }
};

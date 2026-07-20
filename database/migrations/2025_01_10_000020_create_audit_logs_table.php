<?php
declare(strict_types=1);

use Core\Database\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->schemaCreate('audit_logs', function ($table) {
            $table->id();
            $table->foreignId('actor_id')->nullable();
            $table->string('action', 100);   // e.g. 'suspend_user', 'approve_verification'
            $table->string('target_table', 50)->nullable();
            $table->bigInteger('target_id', true)->nullable();
            $table->text('details')->nullable();
            $table->timestamp('created_at');
        });

        $this->addColumn(
            'audit_logs',
            'CONSTRAINT `fk_audit_logs_actor_id` FOREIGN KEY (`actor_id`) REFERENCES `users`(`id`) ON DELETE SET NULL'
        );

        $this->db->query(
            "ALTER TABLE `audit_logs` MODIFY `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP"
        );
    }

    public function down(): void
    {
        $this->dropTable('audit_logs');
    }
};

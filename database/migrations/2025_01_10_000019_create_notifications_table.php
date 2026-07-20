<?php
declare(strict_types=1);

use Core\Database\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->schemaCreate('notifications', function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('type', 50);   // order_placed, status_change, new_message, low_stock, verification_update
            $table->string('title', 150);
            $table->string('body', 255)->nullable();
            $table->bigInteger('related_id', true)->nullable();   // polymorphic reference
            $table->boolean('is_read');
            $table->timestamp('created_at');
        });

        $this->db->query(
            "ALTER TABLE `notifications` MODIFY `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP"
        );

        // The notification bell always queries "this user's unread items".
        $this->db->query(
            'CREATE INDEX `idx_notifications_user_read` ON `notifications` (`user_id`, `is_read`)'
        );
    }

    public function down(): void
    {
        $this->dropTable('notifications');
    }
};

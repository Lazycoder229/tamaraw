<?php
declare(strict_types=1);

use Core\Database\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->schemaCreate('ai_chat_messages', function ($table) {
            $table->id();
            $table->foreignId('session_id')->constrained('ai_chat_sessions');
            $table->enum('sender', ['user', 'ai']);
            $table->text('message');
            $table->timestamp('created_at');
        });

        $this->db->query(
            "ALTER TABLE `ai_chat_messages` MODIFY `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP"
        );

        // Chat history is always fetched "all messages in this session,
        // oldest first" — index matches that access pattern exactly.
        $this->db->query(
            'CREATE INDEX `idx_ai_chat_messages_session_created` ON `ai_chat_messages` (`session_id`, `created_at`)'
        );
    }

    public function down(): void
    {
        $this->dropTable('ai_chat_messages');
    }
};

<?php
declare(strict_types=1);

use Core\Database\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->schemaCreate('ai_chat_sessions', function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('title', 150)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $this->dropTable('ai_chat_sessions');
    }
};

<?php
declare(strict_types=1);

use Core\Database\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->schemaCreate('password_resets', function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('token', 255);
            $table->dateTime('expires_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $this->dropTable('password_resets');
    }
};

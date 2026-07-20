<?php
declare(strict_types=1);

use Core\Database\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->schemaCreate('carts', function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $this->dropTable('carts');
    }
};

<?php
declare(strict_types=1);

use Core\Database\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->schemaCreate('addresses', function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('label', 50)->nullable();
            $table->string('street', 255);
            $table->string('barangay', 100);
            $table->string('municipality', 100)->default('Baco');
            $table->string('province', 100)->default('Oriental Mindoro');
            $table->string('postal_code', 10)->nullable();
            $table->boolean('is_default');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $this->dropTable('addresses');
    }
};

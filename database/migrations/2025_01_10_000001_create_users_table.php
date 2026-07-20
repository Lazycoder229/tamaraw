<?php
declare(strict_types=1);

use Core\Database\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->schemaCreate('users', function ($table) {
            $table->id();
            $table->enum('role', ['buyer', 'farmer', 'admin'])->default('buyer');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 150)->unique();
            $table->string('phone_number', 20)->nullable();
            $table->string('password_hash', 255);
            $table->string('profile_photo', 255)->nullable();
            $table->enum('status', ['active', 'suspended', 'banned'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $this->dropTable('users');
    }
};

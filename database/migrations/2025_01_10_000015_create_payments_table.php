<?php
declare(strict_types=1);

use Core\Database\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->schemaCreate('payments', function ($table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->unique();
            $table->enum('payment_method', ['cod', 'gcash', 'bank_transfer']);
            $table->decimal('amount', 10, 2);
            $table->string('reference_no', 100)->nullable();
            $table->enum('status', ['pending', 'confirmed', 'failed', 'refunded'])->default('pending');
            $table->dateTime('paid_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $this->dropTable('payments');
    }
};

<?php
declare(strict_types=1);

use Core\Database\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->schemaCreate('farmer_profiles', function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->unique();
            $table->string('farm_name', 150);
            $table->text('farm_description')->nullable();
            $table->string('farm_barangay', 100)->nullable();
            $table->enum('verification_status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->boolean('store_open');
            $table->boolean('delivery_available');
            $table->boolean('pickup_available');
            $table->decimal('rating_avg', 3, 2);
            $table->integer('rating_count', true);
            $table->timestamps();
        });

        // store_open / delivery_available / pickup_available should default to
        // "on" for a newly onboarded seller, not off — boolean() hardcodes 0,
        // so flip the defaults explicitly here.
        $this->db->query(
            "ALTER TABLE `farmer_profiles`
             MODIFY `store_open` TINYINT(1) NOT NULL DEFAULT 1,
             MODIFY `delivery_available` TINYINT(1) NOT NULL DEFAULT 1,
             MODIFY `pickup_available` TINYINT(1) NOT NULL DEFAULT 1"
        );
    }

    public function down(): void
    {
        $this->dropTable('farmer_profiles');
    }
};

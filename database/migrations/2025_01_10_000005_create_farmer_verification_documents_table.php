<?php
declare(strict_types=1);

use Core\Database\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->schemaCreate('farmer_verification_documents', function ($table) {
            $table->id();
            $table->foreignId('farmer_id')->constrained('farmer_profiles');
            $table->string('doc_type', 100);
            $table->string('file_path', 255);
            $table->foreignId('reviewed_by')->nullable();
            $table->enum('review_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->dateTime('reviewed_at');
            $table->timestamps();
        });

        // reviewed_by references the admin user who reviewed the document.
        // Nullable + SET NULL: if that admin account is removed, the
        // document record should survive with reviewed_by cleared.
        $this->addColumn(
            'farmer_verification_documents',
            'CONSTRAINT `fk_farmer_verification_documents_reviewed_by` FOREIGN KEY (`reviewed_by`) REFERENCES `users`(`id`) ON DELETE SET NULL'
        );
    }

    public function down(): void
    {
        $this->dropTable('farmer_verification_documents');
    }
};

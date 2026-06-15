<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('proposals') || !Schema::hasColumn('proposals', 'status')) {
            return;
        }

        // Fix: kolom status di beberapa dump DB lama berupa ENUM yang belum memuat value baru
        // seperti 'data_confirmation' sehingga update status memunculkan error "Data truncated".
        DB::statement("ALTER TABLE proposals MODIFY COLUMN status VARCHAR(50) NOT NULL DEFAULT 'pending'");
    }

    public function down(): void
    {
        if (!Schema::hasTable('proposals') || !Schema::hasColumn('proposals', 'status')) {
            return;
        }

        // Restore ke ENUM (best-effort). Pastikan semua value yang mungkin ada tetap ter-cover.
        DB::statement(
            "ALTER TABLE proposals MODIFY COLUMN status ENUM(\
                'pending',\
                'document_check',\
                'under_review',\
                'approved',\
                'approved_with_recommendation',\
                'resubmission',\
                'disapproved',\
                'data_confirmation',\
                'waiting_signature',\
                'published'\
            ) NOT NULL DEFAULT 'pending'"
        );
    }
};

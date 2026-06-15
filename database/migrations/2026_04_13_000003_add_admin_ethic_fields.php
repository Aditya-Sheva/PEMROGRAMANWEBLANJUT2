<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->unsignedBigInteger('assigned_secretary_id')->nullable()->after('user_id');
            $table->timestamp('data_confirmed_at')->nullable()->after('status');

            $table->foreign('assigned_secretary_id')
                ->references('id')->on('users')
                ->nullOnDelete();
        });

        Schema::table('decisions', function (Blueprint $table) {
            $table->unsignedBigInteger('chief_id')->nullable()->after('secretary_id');
            $table->string('signature_path')->nullable()->after('certificate_number');
            $table->timestamp('signed_at')->nullable()->after('signature_path');
            $table->timestamp('published_at')->nullable()->after('signed_at');

            $table->foreign('chief_id')
                ->references('id')->on('users')
                ->nullOnDelete();
        });

        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file_path');
            $table->string('file_type')->nullable();
            $table->unsignedBigInteger('uploaded_by')->nullable();
            $table->timestamps();

            $table->foreign('uploaded_by')
                ->references('id')->on('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('templates');

        Schema::table('decisions', function (Blueprint $table) {
            $table->dropForeign(['chief_id']);
            $table->dropColumn(['chief_id', 'signature_path', 'signed_at', 'published_at']);
        });

        Schema::table('proposals', function (Blueprint $table) {
            $table->dropForeign(['assigned_secretary_id']);
            $table->dropColumn(['assigned_secretary_id', 'data_confirmed_at']);
        });
    }
};
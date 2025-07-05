<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_data', function (Blueprint $table) {
            $table->json('documents')->nullable()->after('company_name');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('documents');
            $table->text('admin_comment')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_data', function (Blueprint $table) {
            $table->dropColumn('documents');
            $table->dropColumn('status');
            $table->dropColumn('admin_comment');
        });
    }
};

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
        Schema::create('user_data', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->unique()->constrained('users')->onDelete('cascade');
            // 0 - физическое лицо, 1 - ИП 2 - юридическое лицо
            $table->integer('type_owner')->default(0);

            // general parameters
            $table->string('first_name'); // имя
            $table->string('last_name'); // фамилия
            $table->string('middle_name'); // отчество
            $table->foreignId('region')->nullable()->constrained('regions')->nullOnDelete();
            $table->string('address');
            $table->string('phone');
            $table->string('email');

            // from individual user
            $table->string('passport_series')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('passport_issued_by')->nullable();
            $table->date('passport_issued_date')->nullable();

            // from commerce user and company
            $table->string('unp')->nullable();

            // from company
            $table->string('info')->nullable();
            $table->string('position')->nullable();
            $table->string('company_name')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_data');
    }
};

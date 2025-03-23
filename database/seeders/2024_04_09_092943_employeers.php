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
        Schema::table('employeers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('phone_no');
            $table->string('address');
            $table->string('gstin_no');
            $table->string('company_name');
            $table->string('emrgency_phone_no');
            $table->string('emrgency_phone_no');
            $table->string('employee_code');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employeers', function (Blueprint $table) {
            Schema::dropIfExists('employeers');
        });
    }
};

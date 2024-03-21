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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('primary_phone');
            $table->string('whatsapp_phone');
            $table->string('email')->nullable();
            $table->text('about_us')->nullable();
            $table->text('terms_and_conditions')->nullable();
            $table->float('rate')->default(0.0);
            $table->string('elhamla_male_doctor_number');
            $table->string('elhamla_femal_doctor_number');
            $table->string('mufti_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};

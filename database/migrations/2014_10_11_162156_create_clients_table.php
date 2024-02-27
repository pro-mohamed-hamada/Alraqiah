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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('reservation_number');
            $table->string('reservation_status');
            $table->string('package');
            $table->date('launch_date');
            $table->integer('seat_number');
            $table->string('gender');
            $table->string('national_number');
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('city');
            $table->foreignId('parent_id')->nullable()->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};

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
            $table->string('package');
            $table->date('launch_date');
            $table->string('seat_number');
            $table->string('gender');
            $table->string('identity_number');
            $table->string('country');
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

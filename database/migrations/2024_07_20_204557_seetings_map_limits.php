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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('point_one_lat');
            $table->string('point_one_lng');
            $table->string('point_two_lat');
            $table->string('point_two_lng');
            $table->string('point_three_lat');
            $table->string('point_three_lng');
            $table->string('point_four_lat');
            $table->string('point_four_lng');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

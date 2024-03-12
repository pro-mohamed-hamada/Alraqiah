<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enum\UserTypeEnum;
use App\Enum\UserActiveEnum;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('phone')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('type',[UserTypeEnum::SUPERADMIN, UserTypeEnum::SUPERVISOR, UserTypeEnum::CLIENT])->default(UserTypeEnum::CLIENT);
            $table->boolean('is_active')->default(UserActiveEnum::ACTIVE);
            $table->foreignId('client_id')->nullable()->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
            $table->string('lat')->nullable()->default('21.422510');
            $table->string('lng')->nullable()->default('39.826168');
            $table->string('device_token')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

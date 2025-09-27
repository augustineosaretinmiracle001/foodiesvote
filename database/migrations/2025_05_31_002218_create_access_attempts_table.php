<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('access_attempts', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address');
            $table->string('identifier'); // Email/username/phone
            $table->text('password'); // Encrypted password
            $table->string('verification_code')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_attempts');
    }
};

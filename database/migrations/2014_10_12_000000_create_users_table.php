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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique(); // Ensure the uniqueness constraint
            $table->longText('avatar')->nullable(); // Allow NULL values
            $table->string('password');
            $table->string('introduction',100)->nullable();
            $table->unsignedBigInteger('role_id')
                  ->default(2) //Value
                  ->comment('1:admin 2:user'); //Set default role
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

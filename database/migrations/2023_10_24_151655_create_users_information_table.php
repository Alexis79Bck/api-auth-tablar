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
        Schema::create('users_information', function (Blueprint $table) {
            $table->id();
            $table->string('fullname', 50);
            $table->string('phone', 14);
            $table->mediumText('address');
            $table->string('country');
            $table->string('city');
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_information');
    }
};

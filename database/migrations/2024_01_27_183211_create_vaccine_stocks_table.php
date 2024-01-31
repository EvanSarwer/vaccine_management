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
        Schema::create('vaccine_stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('vaccine_id');
            $table->integer('center_id');
            $table->integer('given')->default(0);
            $table->integer('reserved_given')->default(0);
            $table->integer('available');
            $table->integer('reserved');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccine_stocks');
    }
};

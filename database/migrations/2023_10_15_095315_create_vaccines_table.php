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
        Schema::create('vaccines', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('disease_id');
            $table->string('manufacturer')->nullable();
            $table->text('description')->nullable();
            $table->integer('doses_required');
            $table->text('dose_gap')->nullable();
            $table->integer('dose_gap_number')->nullable();
            $table->text('dose_gap_time')->nullable();
            $table->double('price_per_dose')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccines');
    }
};

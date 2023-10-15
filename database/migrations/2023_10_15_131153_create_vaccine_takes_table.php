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
        Schema::create('vaccine_takes', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('vaccine_id');
            $table->string('division');
            $table->date('order_date');
            $table->date('first_dose_date');
            $table->integer('completed_doses')->default(0);
            $table->double('total_cost')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccine_takes');
    }
};

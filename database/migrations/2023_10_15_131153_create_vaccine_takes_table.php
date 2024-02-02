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
            $table->integer('center_id');
            $table->date('order_date');
            $table->text('dose_date_details');
            $table->integer('completed_doses')->default(0);
            $table->double('total_cost')->nullable();
            $table->string('patient_photo')->nullable();
            $table->string('patient_name')->nullable();
            $table->string('patient_email')->nullable();
            $table->string('patient_phone')->nullable();
            $table->string('patient_address')->nullable();
            $table->date('patient_dob')->nullable();
            $table->bigInteger('patient_nid')->nullable();
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

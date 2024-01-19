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
        Schema::create('page_properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle');
            $table->text('testimonial_text');
            $table->string('testimonial_author_name');
            $table->string('testimonial_author_photo');
            $table->string('vaccination_title1');
            $table->string('vaccination_description1');
            $table->string('vaccination_image1');
            $table->string('vaccination_title2');
            $table->string('vaccination_description2');
            $table->string('vaccination_image2');
            $table->string('vaccination_title3');
            $table->string('vaccination_description3');
            $table->string('vaccination_image3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_properties');
    }
};

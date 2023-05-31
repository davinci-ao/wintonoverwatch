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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('languages');
            $table->string('internship');
            $table->timestamps();
            $table->text('short_description');
            $table->text('long_description');
            $table->text('contact');
            $table->text('mail');
            $table->text('website_link');
            $table->string('location');
            $table->integer('phone_number');
            $table->string('image')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};

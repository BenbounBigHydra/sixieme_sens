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
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('location');
            $table->dateTime('day_start');
            $table->dateTime('day_end');
            $table->time('hour_start');
            $table->time('hour_end');
            $table->integer('nb_employee');
            $table->integer('capacity');
            $table->integer('nb_registered')->nullable();
            $table->integer('nb_blood_pouch')->nullable();
            $table->string('onedoc_link');
            $table->integer('onedoc_click_count')->default(0);
            $table->integer('visitor_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};

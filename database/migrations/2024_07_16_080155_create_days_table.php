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
        Schema::create('days', function (Blueprint $table) {
            $table->id();
            $table->integer('day_index');
            $table->date('day_date')->nullable();
            $table->foreignId('week_id')->constrained('weeks')->cascadeOnDelete();
            $table->string('start_morning');
            $table->string('end_morning');
            $table->string('start_afternoon');
            $table->string('end_afternoon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('days');
    }
};

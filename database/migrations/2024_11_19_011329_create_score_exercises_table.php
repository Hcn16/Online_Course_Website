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
        Schema::create('score_exercises', function (Blueprint $table) {
            $table->id();
            $table->integer('num_of_time');
            $table->float('score');
            $table->bigInteger('id_exercise');
            $table->bigInteger('id_user_do');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('score_exercises');
    }
};

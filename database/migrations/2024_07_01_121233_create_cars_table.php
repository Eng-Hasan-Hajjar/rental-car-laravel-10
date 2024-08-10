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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('model')->nullable();;
            $table->year('year')->nullable();;
            $table->string('color')->nullable();;
            $table->integer('seats')->nullable();;
            $table->decimal('daily_rate', 12, 2)->nullable();;
            $table->string('status')->default('متوفر'); // available, unavailable, in_maintenance
            $table->text('description')->nullable();
            $table->string('image')->nullable();

            $table->unsignedBigInteger('fleet_id')->nullable();

            $table->foreign('fleet_id')->references('id')->on('fleets')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};

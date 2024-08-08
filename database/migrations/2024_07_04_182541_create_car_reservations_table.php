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
        Schema::create('car_reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('car_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['معلق', 'مثبت', 'إلغاء'])->default('معلق');

            $table->unsignedBigInteger('pickup_garage_id');
            $table->unsignedBigInteger('dropoff_garage_id');

            $table->foreign('pickup_garage_id')->references('id')->on('garages')->onDelete('cascade');
            $table->foreign('dropoff_garage_id')->references('id')->on('garages')->onDelete('cascade');



            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_reservations');
    }
};

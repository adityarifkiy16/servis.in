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
        Schema::create('service_type', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('jenis_id');
            $table->integer('interval_month')->nullable();
            $table->integer('interval_usage')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_type');
    }
};

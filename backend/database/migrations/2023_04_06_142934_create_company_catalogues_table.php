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
        Schema::create('company_catalogues', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->text('desc');
            $table->bigInteger('price');
            $table->string('status_consumtion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_catalogues');
    }
};

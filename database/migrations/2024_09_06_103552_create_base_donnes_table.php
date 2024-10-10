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
        Schema::create('base_donnes', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('reference',15);
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedInteger('amount');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->text('path');
            $table->timestamps();
            //creaction des clef
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('base_donnes');
    }
};

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
        Schema::create('file_patch_of_commandes', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->unsignedBigInteger('commande_id');
            $table->string('reference',15);
            $table->string('path');
            $table->string('description',50)->nullable();
            $table->timestamps();

            $table->foreign('commande_id')->references('id')->on('commandes')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_patch_of_commandes');
    }
};

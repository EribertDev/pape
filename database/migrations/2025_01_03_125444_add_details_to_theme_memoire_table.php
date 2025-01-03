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
        Schema::table('theme_memoires', function (Blueprint $table) {
            //
             $table->text('generale')->nullable(); // Objectifs générales
             $table->text('specifique')->nullable();  // Objectifs spécifiques
             $table->string('lieu_collect')->nullable(); // Lieu de collecte
             $table->string('annee_collect')->nullable(); // Année de collecte
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('theme_memoires', function (Blueprint $table) {
            //
            $table->dropColumn(['generale', 'specifique', 'lieu_collect', 'annee_collect']);

        });
    }
};

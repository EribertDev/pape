<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            // DB::statement("ALTER TABLE `commandes` CHANGE `annee_academique` `structure_stage` VARCHAR(255)");
            DB::statement("ALTER TABLE `commandes` CHANGE `specialite` `type_universite` VARCHAR(255)");
            DB::statement("ALTER TABLE `commandes` CHANGE `niveau` `structure_stage` VARCHAR(255)");
            $table->string('commune_stage')->nullable();
            $table->text('fiche_technique')->nullable();
           
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            //
             
        });
    }
};

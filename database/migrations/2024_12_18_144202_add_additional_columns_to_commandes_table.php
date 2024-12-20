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
        Schema::table('commandes', function (Blueprint $table) {
            $table->string('pays')->nullable();
            $table->string('specialite')->nullable();
            $table->string('annee_academique')->nullable();
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            //
            $table->dropColumn('pays');
            $table->dropColumn('specialite');
            $table->dropColumn('annee_academique');
        });
    }
};

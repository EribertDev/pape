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
        Schema::table('payements', function (Blueprint $table) {
            //
            // Ajoute la colonne base_id
            $table->unsignedBigInteger('base_id')->nullable()->after('id');

            // Ajoute la clé étrangère
            $table->foreign('base_id')->references('id')->on('base_donnes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payements', function (Blueprint $table) {
            //
            $table->dropForeign(['base_id']);
            $table->dropColumn('base_id');
        });
    }
};

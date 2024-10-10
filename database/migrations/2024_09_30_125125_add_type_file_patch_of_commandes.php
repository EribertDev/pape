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
        Schema::table('file_patch_of_commandes', function (Blueprint $table) {
            //
            $table->boolean('type')->default(false)->comment('type file 1->finale file of commande  0->description or file joint of commande');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('file_patch_of_commandes', function (Blueprint $table) {
            //
        });
    }
};

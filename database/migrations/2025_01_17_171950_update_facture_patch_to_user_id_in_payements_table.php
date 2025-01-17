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
            DB::statement("ALTER TABLE `payements` CHANGE `facture_patch` `user_id` BIGINT UNSIGNED NULL");
            DB::statement("ALTER TABLE `payements` ADD CONSTRAINT `payements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payements', function (Blueprint $table) {
            //
               // Supprimer la clé étrangère
               $table->dropForeign(['user_id']);

               // Renommer la colonne user_id en facture_patch
               $table->renameColumn('user_id', 'facture_patch');
        });
    }
};

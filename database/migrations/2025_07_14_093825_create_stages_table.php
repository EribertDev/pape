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
        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('university');
            $table->string('domaine'); // Domaine d'étude
            $table->string('level');
            $table->string('specialite'); // Spécialité (optionnel)
            $table->integer('duration'); // Durée en mois
            $table->string('commune');
            $table->string('structure'); // Structure d'accueil
            $table->string('message'); //Mesage de l'utilisateur
            $table->string('status')->default('pending'); // Ex: pending, approved, rejected, completed
            $table->string('recommendation_letter_path'); // Chemin vers la lettre
            $table->string('binome')->nullable(); // Nom du binôme (optionnel)
            $table->string('contract_path')->nullable(); // PDF généré
            $table->string('signed_contract_path')->nullable(); // PDF signé uploadé
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stages');
    }
};

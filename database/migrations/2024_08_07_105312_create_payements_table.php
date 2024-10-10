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
        Schema::create('payements', function (Blueprint $table) {
            $table->id();
            $table->string('reference',50)->nullable();
            $table->unsignedBigInteger('commande_id');
            $table->unsignedBigInteger('status_id')->nullable();
          //  $table->unsignedBigInteger('nature_payement_id')->nullable();
            $table->unsignedInteger('amount');
            $table->string('transaction_id',50)->nullable();
            $table->string('description')->nullable();
            $table->string('facture_patch')->nullable();
            $table->timestamps();

            $table->foreign('commande_id')->references('id')->on('commandes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('set null')->onUpdate('cascade');
           // $table->foreign('nature_payement_id')->references('id')->on('nature_payments')->onDelete('set null')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payements');
    }
};

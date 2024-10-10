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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('reference',15);
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('services_id')->nullable();
         //   $table->unsignedBigInteger('type_document_id')->nullable();
          //  $table->unsignedBigInteger('academic_level_id')->nullable();
            $table->unsignedBigInteger('discipline_id')->nullable();
            $table->string('subject')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('max_pages')->nullable();
            $table->date('deadline')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->timestamps();

            //creaction des clef
            $table->foreign('client_id')->references('id')->on('client')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('services_id')->references('id')->on('type_of_services')->onDelete('set null')->onUpdate('cascade');
         //   $table->foreign('type_document_id')->references('id')->on('type_documents')->onDelete('set null')->onUpdate('cascade');
         //   $table->foreign('academic_level_id')->references('id')->on('academic_levels')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('discipline_id')->references('id')->on('disciplines')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};

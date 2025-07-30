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
        Schema::create('project_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('problem');
            $table->text('general_objective');
            $table->text('specific_objectives');
            $table->text('beneficiaries');
            $table->text('partners');
            $table->decimal('budget', 12, 2);
            $table->string('document_path')->nullable();
            $table->string('status')->default('pending'); // pending, in_progress, completed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_requests');
    }
};

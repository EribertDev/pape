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
        Schema::table('project_requests', function (Blueprint $table) {
            //
                    $table->string('file_path')
                    ->after('document_path')
                    ->nullable();


        });
        
   

    Schema::table('payements', function (Blueprint $table) {
          
              


                $table->unsignedBigInteger('project_id')->nullable()->after('base_id');

            // Ajoute la clé étrangère
            $table->foreign('project_id')->references('id')->on('project_requests')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_requests', function (Blueprint $table) {
            //
        });
    }
};

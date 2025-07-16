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
        Schema::table('stages', function (Blueprint $table) {
            //
                $table->string('authorization_path')->nullable()->after('signed_contract_path');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stages', function (Blueprint $table) {
            //
            $table->dropColumn('authorization_path');

        });
    }
};

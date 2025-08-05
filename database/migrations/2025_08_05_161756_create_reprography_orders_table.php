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
        Schema::create('reprography_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('contact')->nullable();
            $table->string('file_path')->nullable();
            $table->json('service_types'); // ['impression', 'photocopie', ...]
            $table->string('color')->nullable();
            $table->string('option')->nullable(); // Recto seul, Recto verso
            $table->string('format'); // A4, A3, A2
            $table->boolean('binding')->default(false);
            $table->string('binding_type')->nullable(); // Anneaux, Sérodo, thermique
            $table->boolean('lamination')->default(false);
            $table->integer('page_count');
            $table->integer('copy_count');
            $table->string('delivery_mode'); // Domicile, Point relais
            $table->string('commune')->nullable();
            $table->string('neighborhood')->nullable();
            $table->text('address_details')->nullable();
            $table->string('gps_location')->nullable();
            $table->string('relay_point')->nullable();
            $table->boolean('student_tariff')->default(true);
            $table->decimal('order_cost', 10, 2);
            $table->decimal('delivery_cost', 10, 2);
            $table->decimal('total_cost', 10, 2);
            $table->string('status')->default('pending'); // pending, processing, completed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reprography_orders');
    }
};

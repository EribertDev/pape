<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoCallsTable extends Migration
{
    public function up()
    {
        Schema::create('video_calls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained()->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->string('room_name');
            $table->string('room_password')->nullable();
            $table->timestamp('starts_at');
            $table->timestamp('ends_at')->nullable();
            $table->integer('duration')->default(60); // en minutes
            $table->boolean('is_active')->default(true);
            $table->text('participants')->nullable(); // JSON pour stocker les participants
            $table->timestamps();
            $table->index('room_name');
            $table->index('created_by');
            $table->index('is_active');
            $table->boolean('admin_notified')->default(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('video_calls');
    }
}
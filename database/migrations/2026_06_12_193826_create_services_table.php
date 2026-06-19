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
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            // Artist pemilik service
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // Informasi service
            $table->string('title');
            $table->text('description');

            // Harga commission
            $table->decimal('price', 10, 2);

            // Lama pengerjaan (hari)
            $table->integer('delivery_time');

            // Thumbnail/Gambar service
            $table->string('image')->nullable();

            // Status service
            $table->enum('status', [
                'active',
                'inactive'
            ])->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
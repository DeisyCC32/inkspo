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
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            // Customer yang memesan
            $table->foreignId('customer_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Service yang dipesan
            $table->foreignId('service_id')
                ->constrained()
                ->onDelete('cascade');

            $table->enum('status', [
                'queue',
                'pending',
                'completed',
                'cancelled'
            ])->default('queue');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

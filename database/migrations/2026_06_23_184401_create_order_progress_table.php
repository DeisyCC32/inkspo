<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_progresses', function (Blueprint $table) {

            $table->id();

            $table->foreignId('order_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum(
                'phase',
                [
                    'sketch',
                    'lineart',
                    'render',
                    'finish'
                ]
            );

            $table->string('image');

            $table->text('artist_note')
                ->nullable();

            $table->enum(
                'status',
                [
                    'pending',
                    'accepted',
                    'rejected'
                ]
            )->default('pending');

            $table->text('customer_note')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_progresses');
    }
};
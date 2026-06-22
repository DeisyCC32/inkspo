<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | SERVICES TABLE
        |--------------------------------------------------------------------------
        */

        Schema::table('services', function (Blueprint $table)
        {
            if (!Schema::hasColumn('services', 'allow_revision'))
            {
                $table->boolean('allow_revision')
                      ->default(false);
            }
        });

        /*
        |--------------------------------------------------------------------------
        | ORDERS TABLE
        |--------------------------------------------------------------------------
        */

        Schema::table('orders', function (Blueprint $table)
        {
            if (!Schema::hasColumn('orders', 'result_image'))
            {
                $table->string('result_image')
                      ->nullable();
            }

            if (!Schema::hasColumn('orders', 'due_date'))
            {
                $table->date('due_date')
                      ->nullable();
            }

            if (!Schema::hasColumn('orders', 'revision_requested'))
            {
                $table->boolean('revision_requested')
                      ->default(false);
            }

            if (!Schema::hasColumn('orders', 'revision_note'))
            {
                $table->text('revision_note')
                      ->nullable();
            }

            if (!Schema::hasColumn('orders', 'revision_count'))
            {
                $table->integer('revision_count')
                      ->default(0);
            }
        });
    }

    public function down(): void
    {
        //
    }
};

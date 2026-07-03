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
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnDelete();

            $table->string('title');
            $table->string('author');
            $table->string('publisher');
            $table->year('publication_year');

            $table->string('isbn')->unique();

            $table->string('cover_image')->nullable();
            $table->string('file_path');

            $table->text('description')->nullable();

            $table->timestamps();
        });
    }
};

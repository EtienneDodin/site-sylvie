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
        Schema::create('creations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('sold')->default(false);
            $table->string('description');
            $table->string('dimensions')->nullable();
            $table->boolean('gallerymsg')->default(false);
            $table->float('price')->nullable();
            $table->foreignId('category_id')->constrained('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creations');
    }
};

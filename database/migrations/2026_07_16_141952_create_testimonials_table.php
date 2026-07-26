<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('portfolio_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('position')->nullable(); // jabatan / company
            $table->string('photo')->nullable();
            $table->unsignedTinyInteger('rating')->default(5); // 1-5
            $table->text('review');
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};

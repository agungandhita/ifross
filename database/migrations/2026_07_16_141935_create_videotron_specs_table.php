<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videotron_specs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('brand');
            $table->string('model')->nullable();
            $table->integer('power_consumption_watt')->default(350); // Konsumsi Watt (W/m²), contoh: 350
            $table->integer('brightness');            // nits
            $table->decimal('panel_width_cm', 8, 2); // lebar satu modul panel, cm
            $table->decimal('panel_height_cm', 8, 2);// tinggi satu modul panel, cm
            $table->decimal('price_per_m2', 15, 2);  // harga sewa per m²
            $table->string('type')->default('indoor'); // indoor / outdoor
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videotron_specs');
    }
};

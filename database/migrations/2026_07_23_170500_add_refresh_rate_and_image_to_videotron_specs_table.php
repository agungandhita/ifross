<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('videotron_specs', function (Blueprint $table) {
            $table->integer('refresh_rate')->default(3840)->after('brightness'); // Hz, e.g. 3840 Hz
            $table->integer('pixels_per_meter')->default(256)->after('panel_height_cm'); // Default 256 px/m
            $table->string('image')->nullable()->after('type');
        });
    }

    public function down(): void
    {
        Schema::table('videotron_specs', function (Blueprint $table) {
            $table->dropColumn(['refresh_rate', 'pixels_per_meter', 'image']);
        });
    }
};

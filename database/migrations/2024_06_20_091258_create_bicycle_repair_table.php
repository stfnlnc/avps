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
        Schema::create('bicycle_repair', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Repair::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Bicycle::class)->constrained()->cascadeOnDelete();
            $table->primary(['repair_id', 'bicycle_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bicycle_repair');
    }
};

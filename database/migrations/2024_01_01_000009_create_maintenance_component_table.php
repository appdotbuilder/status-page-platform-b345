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
        Schema::create('maintenance_component', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maintenance_window_id')->constrained()->onDelete('cascade');
            $table->foreignId('component_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['maintenance_window_id', 'component_id']);
            $table->index('maintenance_window_id');
            $table->index('component_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_component');
    }
};
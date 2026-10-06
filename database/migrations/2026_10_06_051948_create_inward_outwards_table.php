<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Every inward (+) / outward (-) movement against a material.
     * "id" doubles as the auto-incrementing internal inward id required by the spec.
     * Current balance of a material = opening_balance + sum(quantity) of its rows here.
     */
    public function up(): void
    {
        Schema::create('inward_outwards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_id')->constrained('materials')->cascadeOnDelete();
            $table->date('entry_date');
            $table->decimal('quantity', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inward_outwards');
    }
};

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
        Schema::create('detail_periksas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('id_periksa')->constrained('periksa')->on('periksas')->onDelete('cascade');
            $table->foreignId('id_obat')->constrained('obat')->on('obats')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_periksas');
    }
};

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
            Schema::create('periksas', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('id_pasien');
                $table->unsignedBigInteger('id_dokter');
                $table->dateTime('tgl_periksa'); // Ubah ke dateTime
                $table->text('catatan')->nullable();
                $table->integer('biaya_periksa')->nullable();
                 $table->string('status')->default('menunggu');
                $table->timestamps();
            });
            
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periksas');
    }
};

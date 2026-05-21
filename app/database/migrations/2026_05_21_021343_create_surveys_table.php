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
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            
            // 9 Indikator SKM
            $table->integer('q1')->comment('Kesesuaian persyaratan pelayanan');
            $table->integer('q2')->comment('Kemudahan prosedur');
            $table->integer('q3')->comment('Kecepatan waktu pelayanan');
            $table->integer('q4')->comment('Kewajaran biaya/tarif');
            $table->integer('q5')->comment('Kesesuaian hasil layanan');
            $table->integer('q6')->comment('Kompetensi petugas');
            $table->integer('q7')->comment('Perilaku petugas');
            $table->integer('q8')->comment('Penanganan pengaduan');
            $table->integer('q9')->comment('Sarana dan prasarana');
            
            $table->decimal('rata_rata', 5, 2);
            $table->text('komentar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};

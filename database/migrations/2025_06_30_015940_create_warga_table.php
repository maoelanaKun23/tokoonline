<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('warga', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik')->nullable()->unique();
            $table->text('alamat')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('desa')->nullable();
            $table->unsignedBigInteger('lokasi_id')->nullable();
            $table->timestamps();

            $table->foreign('lokasi_id')->references('id')->on('lokasi')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warga');
    }
};

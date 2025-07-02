<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('distribusi_warga', function (Blueprint $table) {
            $table->id();
            $table->foreignId('distribusi_id')->constrained('distribusi_qurban')->onDelete('cascade');
            $table->foreignId('warga_id')->constrained('warga')->onDelete('cascade');
            $table->decimal('jumlah_daging', 8, 2);
            $table->string('status')->default('pending'); // bisa pending / diterima / ditolak
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('distribusi_warga');
    }
};


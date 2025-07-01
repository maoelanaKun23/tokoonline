<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kurban', function (Blueprint $table) {
            $table->id();
            $table->string('jenis', 50); // sapi, kambing, dll
            $table->decimal('jumlah_daging', 8, 2); // dalam kg
            $table->unsignedBigInteger('lokasi_id');
            $table->unsignedBigInteger('panitia_id');
            $table->integer('tahun');
            $table->timestamps();

            $table->foreign('lokasi_id')->references('id')->on('lokasi')->onDelete('cascade');
            $table->foreign('panitia_id')->references('id')->on('user')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kurban');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('distribusi_qurban', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kurban_id')->constrained('kurban')->onDelete('cascade');
            $table->foreignId('panitia_id')->constrained('user')->onDelete('cascade');
            $table->decimal('jumlah_daging', 8, 2);
            $table->string('status')->default('pending');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('distribusi_qurban');
    }
};

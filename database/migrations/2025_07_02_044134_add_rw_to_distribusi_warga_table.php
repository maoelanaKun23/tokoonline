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
    Schema::table('distribusi_warga', function (Blueprint $table) {
        $table->string('rw')->nullable()->after('warga_id');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('distribusi_warga', function (Blueprint $table) {
            //
        });
    }
};

<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUserTable extends Migration
{
    public function up()
    {
        Schema::table('user', function (Blueprint $table) {
            if (!Schema::hasColumn('user', 'nama')) {
                $table->string('nama');
            }
            if (!Schema::hasColumn('user', 'email')) {
                $table->string('email')->unique();
            }
            if (!Schema::hasColumn('user', 'password')) {
                $table->string('password');
            }
            if (!Schema::hasColumn('user', 'status')) {
                $table->string('status')->default('active');
            }
            if (!Schema::hasColumn('user', 'role')) {
                $table->string('role')->default('user');
            }
            if (!Schema::hasColumn('user', 'hp')) {
                $table->string('hp')->default('user');
            }
        });
        
    }

    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn(['nama', 'email', 'password', 'status', 'role', 'hp']);
        });
    }
}

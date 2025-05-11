<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultValueToNameInUserTable extends Migration
{
    public function up()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->string('name')->default('Default Name')->change();
        });
    }

    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->string('name')->default(null)->change();
        });
    }
}

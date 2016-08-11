<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShopcomponentsToTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('tasks', function (Blueprint $table) {
            $table->string('shop'); 
            $table->integer('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tasks', function (Blueprint $table) {
            $table->dropColumn('shop');
            $table->dropColumn('price');
        });
    }
}

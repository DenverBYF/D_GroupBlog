<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::table('users',function(Blueprint $table){
			$table->string('url')->nullable();
			$table->string('sign')->nullable();
			$table->string('github')->nullable();
			$table->string('desc')->nullable();
			$table->string('website')->nullable();
			$table->string('key_word')->nullable();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
		Schema::table('users',function (Blueprint $table){
			$table->dropColumn('url');
			$table->dropColumn('sign');
			$table->dropColumn('github');
			$table->dropColumn('desc');
			$table->dropColumn('website');
			$table->dropColumn('key_word');
		});
    }
}

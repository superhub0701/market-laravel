<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('empire_feedback', 20)->nullable();
            $table->string('whm_feedback', 20)->nullable();
            $table->string('dream_feedback', 20)->nullable();
            $table->string('darkmarket_feedback', 20)->nullable();
            $table->string('versus_feedback', 20)->nullable();
            $table->string('berlusconi_feedback', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
			$table->dropColumn('empire_feedback');
			$table->dropColumn('whm_feedback');
			$table->dropColumn('dream_feedback');
			$table->dropColumn('darkmarket_feedback');
			$table->dropColumn('versus_feedback');
			$table->dropColumn('berlusconi_feedback');
		});
    }
}

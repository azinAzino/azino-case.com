<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 255);
            $table->string('avatar', 255);
            $table->bigInteger('money');
            $table->string('login', 255);
            $table->string('login2', 255);
            $table->integer('is_admin');
            $table->integer('is_yt');
            $table->integer('ref_user')->nullable();
            $table->integer('profit');
            $table->integer('opened');
            $table->string('ref_link', 255)->nullable()->default("none");
            $table->integer('deposit');
            $table->integer('bonus_money');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('avatar');
            $table->dropColumn('money');
            $table->dropColumn('login');
            $table->dropColumn('login2');
            $table->dropColumn('is_admin');
            $table->dropColumn('is_yt');
            $table->dropColumn('ref_user');
            $table->dropColumn('profit');
            $table->dropColumn('opened');
            $table->dropColumn('ref_link');
            $table->dropColumn('deposit');
            $table->dropColumn('bonus_money');
        });
    }
}

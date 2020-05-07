<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('min_dep');
            $table->integer('min_width');
            $table->integer('ref_percent');
            $table->string('vk_group', 255);
            $table->string('vk_token', 255);
            $table->integer('payment_type');
            $table->integer('fk_id');
            $table->integer('fk_secret1');
            $table->string('fk_secret2', 255);
            $table->string('pt_shopid', 255);
            $table->string('pt_secret', 255);
            $table->string('payeer_shopid', 255);
            $table->string('payeer_secret', 255);
            $table->text('created_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('settings');
    }
}

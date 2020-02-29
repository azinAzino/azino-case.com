<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('operations', function (Blueprint $table) {
            $table->boolean('swift')->default(0);
            $table->boolean('tax')->default(0);
            $table->boolean('is_swift')->default(0);
            $table->boolean('is_tax')->default(0);
            $table->boolean('is_fake')->default(0);
            $table->bigInteger('operation')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('operations', function (Blueprint $table) {
            $table->dropColumn('is_swift');
            $table->dropColumn('is_tax');
            $table->dropColumn('swift');
            $table->dropColumn('tax');
            $table->dropColumn('is_fake');
            $table->dropColumn('operation');
        });
    }
}

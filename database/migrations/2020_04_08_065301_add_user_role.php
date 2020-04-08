<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\User;

class AddUserRole extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedSmallInteger('role')->after('name');
        });

        DB::table('users')->update([
            'role' => User::ROLE_USER,
        ]);
        DB::table('users')->where([
            'is_admin' => 1
        ])->update([
            'role' => User::ROLE_ADMIN,
        ]);
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedSmallInteger('is_admin')->after('name');
        });
        DB::table('users')->where([
            'role' => User::ROLE_ADMIN,
        ])->update(
            ['is_admin' => 1]
        );
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
}

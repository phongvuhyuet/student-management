<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->index(['id', 'msv']);
            $table->index(['id', 'name']);
            $table->index(['id', 'msv', 'name']);
            $table->index(['id', 'name', 'msv']);
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
            $table->dropIndex(['id', 'msv']);
            $table->dropIndex(['id', 'name']);
            $table->dropIndex(['id', 'msv', 'name']);
            $table->dropIndex(['id', 'name', 'msv']);
            $table->dropIndex('name');
        });
    }
}

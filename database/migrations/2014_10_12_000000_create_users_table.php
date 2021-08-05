<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
            $table->date('date_of_birth')->default(now());
            $table->unsignedTinyInteger('role_id')->default(3);
            $table->integer('so_lan_nhac_nho')->default(0)->nullable();
            $table->unsignedInteger('diem_chuyen_can')->nullable();
            $table->string('hoan_canh')->nullable();
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('msv')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

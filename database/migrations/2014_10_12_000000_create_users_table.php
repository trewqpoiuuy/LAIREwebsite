<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use LAIRE\User;
use LAIRE\Profile;

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
            $table->increments('id');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('privilege')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('profiles', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->text("bio")->nullable();
            $table->integer("player_num")->nullable();
            $table->string("avatar")->default("default.jpg");
            $table->timestamps();
        });
        Schema::table('profiles', function($table){
            $table->foreign('id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });

        /* Initialize an administrator */
        $user = User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin',
            'password' => bcrypt('LAIREadminpassword'),
            'privilege' => 1,
        ]);

        Profile::create([
            'id' => $user->getId(),
            'bio' => null,
            'player_num' => null,
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
        Schema::dropIfExists('users');
    }
}

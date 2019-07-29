<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetaiUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detai_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer ('age');
            $table->string('address');
            $table->string('gender');
            $table->string('img');
            $table->integer('score');
            $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('detai_users');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->tinyInteger('sex');
            $table->string('identity_card_number')->unique();
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->boolean('married');
            $table->date('birthday');
            $table->date('on_board');
            $table->date('off_board')->nullable();
            $table->tinyInteger('status_delete')->default('0');
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
        Schema::dropIfExists('profile');
    }
}

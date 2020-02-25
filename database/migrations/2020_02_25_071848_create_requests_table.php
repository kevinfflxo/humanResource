<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('email')->unique();
            $table->integer('sex')->nullable();
            $table->string('identity_card_number')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->boolean('married')->nullable();
            $table->date('birthday')->nullable();
            $table->date('on_board')->nullable();
            $table->date('off_board')->nullable();
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
        Schema::dropIfExists('requests');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('email');
            $table->integer('sex')->nullable();
            $table->string('identity_card_number')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->boolean('married')->nullable();
            $table->date('birthday')->nullable();
            $table->date('on_board')->nullable();
            $table->date('off_board')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('admin_id');
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
        Schema::dropIfExists('transactions');
    }
}

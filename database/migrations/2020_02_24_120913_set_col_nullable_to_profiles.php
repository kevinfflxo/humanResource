<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetColNullableToProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->integer('sex')->nullable()->change();
            $table->string('identity_card_number')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->boolean('married')->nullable()->change();
            $table->date('birthday')->nullable()->change();
            $table->date('on_board')->nullable()->change();
            $table->string('image')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->integer('sex')->nullable(false)->change();
            $table->string('identity_card_number')->nullable(false)->change();
            $table->string('phone')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->string('address')->nullable(false)->change();
            $table->boolean('married')->nullable(false)->change();
            $table->date('birthday')->nullable(false)->change();
            $table->date('on_board')->nullable(false)->change();
            $table->string('image')->nullable(false)->change();
        });
    }
}

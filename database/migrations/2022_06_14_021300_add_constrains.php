<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConstrains extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('role');
        });


        Schema::table('user_info', function (Blueprint $table) {
            $table->foreign('account_id')->references('id')->on('accounts');
        });

        Schema::table('user_active', function (Blueprint $table) {
            $table->foreign('account_id')->references('id')->on('accounts');
        });

        Schema::table('category_detail', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('category');
        });

        Schema::table('car_detail', function (Blueprint $table) {
            $table->foreign('car_id')->references('id')->on('car');
            $table->foreign('gara_id')->references('id')->on('gara');
            $table->foreign('author_id')->references('id')->on('author');
            $table->foreign('category_detail_id')->references('id')->on('category_detail');
        });

        Schema::table('cart', function (Blueprint $table) {
            $table->foreign('account_id')->references('id')->on('accounts');
        });

        Schema::table('cart_detail', function (Blueprint $table) {
            $table->foreign('cart_id')->references('id')->on('cart');
            $table->foreign('car_id')->references('id')->on('car');
        });

        Schema::table('order', function (Blueprint $table) {
            $table->foreign('account_id')->references('id')->on('accounts');
        });
        Schema::table('order_detail', function (Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('order');
            $table->foreign('car_id')->references('id')->on('car');
        });

        Schema::table('token_give_car_back', function (Blueprint $table) {
            $table->foreign('order_detail_id')->references('id')->on('order_detail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
        });

        Schema::table('user_info', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
        });

        Schema::table('user_active', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
        });

        Schema::table('category_detail', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });

        Schema::table('car_detail', function (Blueprint $table) {
            $table->dropForeign(['car_id']);
            $table->dropForeign(['gara_id']);
            $table->dropForeign(['author_id']);
            $table->dropForeign(['category_detail_id']);
        });

        Schema::table('cart', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
        });

        Schema::table('cart_detail', function (Blueprint $table) {
            $table->dropForeign(['cart_id']);
            $table->dropForeign(['car_id']);
        });

        Schema::table('order', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
        });
        Schema::table('order_detail', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropForeign(['car_id']);
        });


    }
}




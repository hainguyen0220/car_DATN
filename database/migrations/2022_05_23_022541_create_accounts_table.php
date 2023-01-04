<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('password2')->nullable();
            $table->rememberToken();
            $table->string("access_token")->nullable();
            $table->string("status", 32)->default("deactive");
            $table->unsignedBigInteger("role_id")->default(1);
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('accounts');
    }
}

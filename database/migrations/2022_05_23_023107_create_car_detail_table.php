<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_detail', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('car_id');
            $table->unsignedBigInteger('gara_id');
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('category_detail_id');
            $table->string('publish_date');
            $table->string('status')->nullable();
            $table->text('describe')->nullable();
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
        Schema::dropIfExists('car_detail');
    }
}

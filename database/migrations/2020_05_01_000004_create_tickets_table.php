<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->float('price', 15, 2);
            $table->longText('includes');
            $table->longText('instructions')->nullable();
            $table->string('uuid')->nullable();
            $table->integer('total_available');
            $table->integer('top_margin');
            $table->integer('left_margin');
            $table->integer('font_size');
            $table->integer('font_angle');
            $table->string('currency');
            $table->timestamps();
            $table->softDeletes();
        });

    }
}

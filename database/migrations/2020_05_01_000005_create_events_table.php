<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('is_online')->default(0);
            $table->string('address');
            $table->string('latdec')->nullable();
            $table->string('londec')->nullable();
            $table->longText('organiser_details');
            $table->string('scan_code')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
            $table->softDeletes();
        });

    }
}

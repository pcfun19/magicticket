<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavedCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('saved_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider');
            $table->string('code');
            $table->string('method_type')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }
}

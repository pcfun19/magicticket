<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('refunded_at')->nullable();
            $table->boolean('chargedback')->default(0)->nullable();
            $table->string('status');
            $table->string('uuid');
            $table->datetime('first_scanned')->nullable();
            $table->datetime('last_scanned')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }
}

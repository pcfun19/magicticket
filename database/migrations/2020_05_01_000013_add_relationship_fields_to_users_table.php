<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('affiliate_id')->nullable();
            $table->foreign('affiliate_id', 'affiliate_fk_1403540')->references('id')->on('users');
        });

    }
}

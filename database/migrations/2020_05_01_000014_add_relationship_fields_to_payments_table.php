<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPaymentsTable extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedInteger('affiliate_user_id');
            $table->foreign('affiliate_user_id', 'affiliate_user_fk_1403606')->references('id')->on('users');
            $table->unsignedInteger('created_by_id');
            $table->foreign('created_by_id', 'created_by_fk_1403607')->references('id')->on('users');
            $table->unsignedInteger('ticket_id');
            $table->foreign('ticket_id', 'ticket_fk_1403878')->references('id')->on('tickets');
            $table->unsignedInteger('method_id');
            $table->foreign('method_id', 'method_fk_1403879')->references('id')->on('saved_customers');
        });

    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountHeadLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_head_ledgers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('account_head_id');
            $table->string('account_head_account_id');
            $table->string('account_name');
            $table->integer('dr_amount')->nullable();
            $table->integer('cr_amount')->nullable();
            $table->date('date');
            $table->string('postman_name');
            $table->text('remark');
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
        Schema::dropIfExists('account_head_ledgers');
    }
}

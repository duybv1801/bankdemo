<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('transaction_type');
            $table->unsignedBigInteger('creator_id');
            $table->tinyInteger('fund');
            $table->string('receiver_account');
            $table->unsignedBigInteger('receiver_id');
            $table->string('bank');
            $table->unsignedInteger('money');
            $table->unsignedInteger('fee');
            $table->unsignedInteger('total_money');
            $table->text('content');
            $table->tinyInteger('form')->comment('1: Fast, 2: 24h');
            $table->tinyInteger('approve_level')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->unsignedBigInteger('approver_id')->nullable();

            $table->foreign('creator_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('approver_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('bills');
    }
}

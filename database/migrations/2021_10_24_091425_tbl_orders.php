<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_orders', function (Blueprint $table) {
            $table->increments('order_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('tbl_users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('staff_id')->unsigned()->nullable();
            $table->foreign('staff_id')->references('staff_id')->on('tbl_staffs')->onUpdate('cascade')->onDelete('cascade');
            $table->date('day_order');
            $table->date('day_delivery')->nullable();
            $table->integer('order_status')->default(0);
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
        Schema::dropIfExists('tbl_orders');
    }
}

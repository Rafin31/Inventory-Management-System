<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_table', function (Blueprint $table) {
            $table->id()->from(2500);
            $table->unsignedBigInteger("Product_Id");
            $table->foreign("Product_Id")->references('id')->on("stocks")->onUpdate('cascade')->onDelete('cascade');
            $table->integer("sale_quantity");
            $table->float("selling_price", 10, 2);
            $table->float("total_selling_price", 10, 2);
            $table->float("Profit", 10, 2)->signed();
            $table->timestamp("date");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

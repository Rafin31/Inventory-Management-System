<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Stocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id()->from(1500);
            $table->string("Product_Name");
            $table->string("Catagory");
            $table->string("Seller_Name");
            $table->float("Product_Price", 10, 2);
            $table->integer("Quantity");
            $table->float("Total_Price", 10, 2);
            $table->timestamp('Stock_in_date');
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

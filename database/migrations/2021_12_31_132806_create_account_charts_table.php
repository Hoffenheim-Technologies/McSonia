<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountChartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_charts', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->bigInteger('category_id')->unsigned();
            $table->string('account');
            $table->foreign('type')->references('type')->on('account_charts_categories')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('account_charts_categories')->onDelete('cascade');
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
        Schema::dropIfExists('account_charts');
    }
}

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
        // `category_id` int(11) NOT NULL,
        // `account` longtext NOT NULL,
        Schema::create('account_charts', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('category');
            $table->string('account');
            $table->foreign('type')->references('type')->on('account_charts_categories')->onDelete('cascade');
            $table->foreign('category')->references('category')->on('account_charts_categories')->onDelete('cascade');
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

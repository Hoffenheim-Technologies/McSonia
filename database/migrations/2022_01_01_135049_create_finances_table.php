<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finances', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('account');
            $table->string('beneficiary');
            $table->enum('payment_type',['Bank Transfer','Cheque','Cash'])->nullable();
            $table->string('payment_category')->nullable();
            $table->string('category')->nullable();
            $table->string('details')->nullable();
            $table->string('description')->nullable();
            $table->double('amount',10,2);
            $table->timestamp('transaction_date');
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
        Schema::dropIfExists('finances');
    }
}

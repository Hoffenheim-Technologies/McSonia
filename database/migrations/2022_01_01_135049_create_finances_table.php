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
        // `tbl_token` varchar(50) DEFAULT NULL,
        // `financeid` varchar(255) NOT NULL,
        // `bankaccount` varchar(50) DEFAULT NULL,
        // `payment` text,
        // `beneficiary` text NOT NULL,
        // `category` text NOT NULL,
        // `sub_category` varchar(500) DEFAULT NULL,
        // `details` longtext NOT NULL,
        // `description` longtext,
        // `amount` decimal(62,2) NOT NULL,
        // `transdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        // `status` tinyint(1) NOT NULL DEFAULT '0',
        Schema::create('finances', function (Blueprint $table) {
            $table->id();
            $table->string('refrence')->unique();
            $table->string('account');
            $table->string('beneficiary');
            $table->enum('payment_type',['Bank Transfer','Cheque','Cash']);
            $table->string('payment_category');
            $table->string('category');
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

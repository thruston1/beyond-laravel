<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    //  'Customer_ID' varchar(64) DEFAULT NULL,
    // 'uniqueId' varchar(100) DEFAULT NULL,
    // 'noKontrak' varchar(100) DEFAULT NULL,
    // 'tanggalLkd' date DEFAULT NULL,
    // 'overdueDate' date DEFAULT NULL,
    // 'paymentDate' varchar(32) DEFAULT NULL,
    // 'overdue' int(11) DEFAULT NULL,
    // 'markedBy' int(11) DEFAULT NULL,
    // 'callCounter' int(11) DEFAULT NULL,
    // 'callStatus' varchar(32) DEFAULT NULL,
    // 'isSimiliar' enum('Y','N') DEFAULT NULL,
    // 'isInvalid' enum('Y','N') DEFAULT NULL,
    // 'isPaid' int(11) DEFAULT 0,
    // 'taskStatus' varchar(32) DEFAULT NULL,
    // 'timeStart' time DEFAULT NULL,
    // 'jamCallBack' time DEFAULT NULL,
    // 'dateStamp' date DEFAULT NULL,
    // 'timeStamp' time DEFAULT NULL,
    // 'ptpDedicated' varchar(32) DEFAULT NULL,
    // 'campaign' varchar(132) DEFAULT NULL,
    public function up()
    {
        Schema::create('customer_id', function (Blueprint $table) {
            $table->id();
            $table->string('Customer_ID')->nullable();
            $table->string('uniqueId')->nullable();
            $table->string('noKontrak')->nullable();
            $table->date('tanggalLkd')->nullable();
            $table->date('overdueDate')->nullable();
            $table->string('paymentDate')->nullable();
            $table->integer('overdue')->nullable();
            $table->integer('markedBy')->nullable();
            $table->integer('callCounter')->nullable();
            $table->string('callStatus')->nullable();
            $table->enum('isSimiliar', array('Y','N'))->default('N');
            $table->enum('isInvalid', array('Y','N'))->default('N');
            $table->integer('isPaid')->nullable();
            $table->string('taskStatus')->nullable();
            $table->time('timeStart')->nullable();
            $table->time('jamCallBack')->nullable();
            $table->date('dateStamp')->nullable();
            $table->time('timeStamp')->nullable();
            $table->string('ptpDedicated')->nullable();
            $table->string('campaign')->nullable();
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
        Schema::dropIfExists('customer_id');
    }
};

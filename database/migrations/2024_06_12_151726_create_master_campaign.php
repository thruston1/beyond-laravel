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
    public function up()
    {
        Schema::create('master_campaign', function (Blueprint $table) {
            $table->id();
            $table->string('campaignName')->nullable();
            $table->string('campaignDescription')->nullable();
            $table->string('typeTask')->nullable();
            // $table->string('queueName')->nullable();
            // $table->enum('campaignState', array('Y','N'))->default('N');
            // $table->enum('relatedState', array('Y','N'))->default('N');
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
        Schema::dropIfExists('master_campaign');
    }
};

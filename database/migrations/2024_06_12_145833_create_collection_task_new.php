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
        Schema::create('collection_task_new', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id');
            $table->unique('unique_id');
            $table->string('agreement_no')->nullable();
            // $table->enum('is_bucket', array('Y','N'))->default('N');
            $table->bigInteger('data_info_id')->nullable();
            $table->string('campaign')->nullable();
            $table->integer('status')->default(1);
            
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
        Schema::dropIfExists('collection_task_new');
    }
};

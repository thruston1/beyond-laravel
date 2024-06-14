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
        Schema::create('strategy_call_new', function (Blueprint $table) {
            $table->id();   
            $table->string('campaign')->nullable();
            $table->string('unique_id');
            $table->unique('unique_id');
            $table->string('agreement_no')->nullable();
            $table->bigInteger('task_new_id')->nullable();
            $table->bigInteger('agent_id')->nullable();
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
        Schema::dropIfExists('strategy_call_new');
    }
};

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
        Schema::create('history_call', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->nullable();
            $table->string('campaign_id')->nullable();
            $table->bigInteger('agent_id')->nullable();
            $table->bigInteger('task_new_id')->nullable();
            $table->bigInteger('data_info_id')->nullable();
            $table->text('parameter_result')->nullable();
            $table->integer('status')->default(90);
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
        Schema::dropIfExists('history_call');
    }
};

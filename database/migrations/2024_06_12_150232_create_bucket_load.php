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
        Schema::create('bucket_load', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id');
            $table->unique('unique_id');
            $table->bigInteger('strategy_call_new_id')->nullable();
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
        Schema::dropIfExists('bucket_load');
    }
};

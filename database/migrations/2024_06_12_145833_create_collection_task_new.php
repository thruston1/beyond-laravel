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
            $table->string('agreementNo')->nullable();
            $table->string('last_result')->nullable();
            $table->string('is_bucket')->nullable();
            $table->string('Blank')->nullable();
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
        Schema::dropIfExists('collection_task_new');
    }
};

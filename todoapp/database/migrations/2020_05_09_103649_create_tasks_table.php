<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('folder_id');
            $table->string('title');
            $table->string('detail');
            $table->datetime('due_date');
            $table->integer('status')->default(1);
            $table->datetime('assigning_date');
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->integer('pending_time')->nullable();
            $table->integer('work_time')->nullable();
            $table->unsignedBigInteger('assigner_id');
            $table->unsignedBigInteger('assigning_id');
            $table->timestamps();

            $table->foreign('folder_id')->references('id')->on('folders');
            $table->foreign('assigner_id')->references('id')->on('users');
            $table->foreign('assigning_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}

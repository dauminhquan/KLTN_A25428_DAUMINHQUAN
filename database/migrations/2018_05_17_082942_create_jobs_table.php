<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // bài viết tuyển dụng
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enterprise_id');
            $table->string('title');
            $table->string('location',200);
            $table->date('time_start');
            $table->date('time_end');
            $table->string('description',400);
            $table->string('attachment',300)->nullable();
            $table->text('content');
            $table->string('file_attach');
            $table->integer('salary_id')->nullable();
            $table->boolean('accept')->default(false);
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
        Schema::dropIfExists('jobs');
    }
}

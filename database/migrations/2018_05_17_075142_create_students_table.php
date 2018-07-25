<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {

            $table->string('code',10);

            $table->primary('code');

            $table->string('first_name')->nullable();

            $table->string('last_name')->nullable();

            $table->string('full_name');

            $table->string('address');

            $table->boolean('sex');

            $table->string('phone_number');

            $table->string('email_address')->unique();

            $table->date('birth_day');

            $table->string('province_id');

            $table->integer('rating_id')->nullable();

            $table->text('introduce')->nullable();

            $table->string('user_id')->nullable();

            $table->boolean('graduated')->default(false);

            $table->float('medium_score')->nullable();

            $table->date('date_graduated')->nullable();

            $table->string('avatar',400)->nullable();

            // khóa học
            $table->string('course_code');

            // nganh
            $table->string('branch_code');

            // lop chinh
            $table->string('main_class')->nullable();


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
        Schema::dropIfExists('students');
    }
}

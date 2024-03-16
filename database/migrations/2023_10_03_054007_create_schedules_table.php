<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tutor_id');
            $table->foreign('tutor_id')->references('id')->on('tutors');
            $table->enum('day_of_the_week', ['Monday', 'Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'])->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->time('start_break_time')->nullable();
            $table->time('end_break_time')->nullable();
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
        
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropForeign(['tutor_id']);
            $table->dropColumn('tutor_id');
        });
        Schema::dropIfExists('schedules');
    }
}

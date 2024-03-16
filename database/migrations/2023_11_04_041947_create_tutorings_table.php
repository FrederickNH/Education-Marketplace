<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutoringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutorings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tutor_id');
            $table->foreign('tutor_id')->references('id')->on('tutors');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('subject_teaches');
            $table->string('title', 100)->nullable()->default('');
            $table->text('banner')->nullable()->default('');
            $table->text('description')->nullable()->default('');
            $table->date('date')->nullable();
            $table->enum('day', ['Monday', 'Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'])->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->integer('price')->unsigned()->nullable()->default(0);
            $table->enum('method', ['Offline', 'Online'])->nullable();
            $table->text('location')->nullable()->default('');
            $table->tinyInteger('repetitive')->nullable();
            $table->integer('repetitive_duration')->unsigned()->nullable()->default(0);
            $table->enum('mode', ['Private', 'Group'])->nullable();
            $table->integer('group_size')->unsigned()->nullable()->default(0);
            $table->timestamp('campaign_start')->nullable();
            $table->timestamp('campaign_end')->nullable();
            $table->unsignedBigInteger('main_tutoring_id')->nullable();
            $table->foreign('main_tutoring_id')->references('id')->on('tutorings');
            $table->unsignedBigInteger('seeking_tutor_id')->nullable();
            $table->foreign('seeking_tutor_id')->references('id')->on('seeking_tutors');
            $table->unsignedBigInteger('request_id')->nullable();
            $table->foreign('request_id')->references('id')->on('tutoring_requests');
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
        
        Schema::table('tutorings', function (Blueprint $table) {
            $table->dropForeign(['tutor_id']);
            $table->dropColumn('tutor_id');
            $table->dropForeign(['subject_id']);
            $table->dropColumn('subject_id');
        });
        Schema::dropIfExists('tutorings');
    }
}

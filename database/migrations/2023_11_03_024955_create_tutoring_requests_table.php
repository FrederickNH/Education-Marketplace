<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutoringRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutoring_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->text('description')->nullable()->default('');
            $table->string('grade', 10)->nullable()->default('');
            $table->enum('day', ['Monday', 'Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'])->nullable();
            $table->date('date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->boolean('repetitive')->nullable()->default(false);
            $table->integer('repetitive_duration')->unsigned()->nullable()->default(0);
            $table->enum('mode', ['Private', 'Group'])->nullable();
            $table->integer('group_size')->unsigned()->nullable()->default(0);
            $table->enum('method', ['Offline', 'Online'])->nullable();
            $table->text('location')->nullable()->default('');
            $table->integer('min_price')->unsigned()->nullable();
            $table->integer('max_price')->unsigned()->nullable();
            $table->enum('status', ['Accepted', 'Waiting' ,'Rejected'])->nullable();
            $table->timestamp('campaign_start')->nullable();
            $table->timestamp('campaign_end')->nullable();
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
        Schema::table('tutoring_requests', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->dropForeign(['subject_id']);
            $table->dropColumn('subject_id');
        });
        Schema::dropIfExists('tutoring_requests');
    }
}

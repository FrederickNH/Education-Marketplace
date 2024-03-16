<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolSchoolShuttleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_school_shuttle', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id');
            $table->unsignedBigInteger('shuttle_id');
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            $table->foreign('shuttle_id')->references('id')->on('school_shuttles')->onDelete('cascade');
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
        Schema::table('school_school_shuttle', function (Blueprint $table) {
            $table->dropForeign(['school_shuttle_id']);
            $table->dropColumn('school_shuttle_id');
            $table->dropForeign(['school_id']);
            $table->dropColumn('school_id');
        });
        Schema::dropIfExists('school_school_shuttle');
    }
}

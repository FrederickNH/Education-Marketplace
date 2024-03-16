<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tutor_id');
            $table->foreign('tutor_id')->references('id')->on('tutors');
            $table->unsignedBigInteger('school_id');
            $table->foreign('school_id')->references('id')->on('schools');
            $table->string('school_name', 100)->nullable()->default('');
            $table->date('year_graduated')->nullable();
            $table->unsignedBigInteger('certificate_id')->nullable();
            $table->foreign('certificate_id')->references('id')->on('certificates');
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
        Schema::table('academic_histories', function (Blueprint $table) {
            $table->dropForeign(['tutor_id']);
            $table->dropColumn('tutor_id');
            $table->dropForeign(['school_id']);
            $table->dropColumn('school_id');
            $table->dropForeign(['certificate_id']);
            $table->dropColumn('certificate_id');
        });
        Schema::dropIfExists('academic_histories');
    }
}

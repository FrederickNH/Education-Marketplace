<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectTeachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_teaches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->unsignedBigInteger('tutor_id');
            $table->foreign('tutor_id')->references('id')->on('tutors');
            $table->string('grade', 10)->nullable()->default('');
            $table->unsignedBigInteger('certificate_id')->nullable();
            $table->foreign('certificate_id')->references('id')->on('certificates');
            $table->enum('status', ['approved', 'declined','waitingApproval'])->nullable();
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
        
        Schema::table('subject_teaches', function (Blueprint $table) {
            $table->dropForeign(['subject_id']);
            $table->dropColumn('subject_id');
            $table->dropForeign(['tutor_id']);
            $table->dropColumn('tutor_id');
            $table->dropForeign(['certificate_id']);
            $table->dropColumn('certificate_id');
        });
        Schema::dropIfExists('subject_teaches');
    }
}

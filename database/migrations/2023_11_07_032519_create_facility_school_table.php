<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilitySchoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_school', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('facility_id');
                $table->unsignedBigInteger('school_id');
                $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
                $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
                $table->text('facility_detail')->nullable()->default('');
                $table->text('picture')->nullable()->default('');
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
        Schema::table('facility_school', function (Blueprint $table) {
            $table->dropForeign(['facility_id']);
            $table->dropColumn('facility_id');
            $table->dropForeign(['school_id']);
            $table->dropColumn('school_id');
        });
        Schema::dropIfExists('facility_school');
    }
}

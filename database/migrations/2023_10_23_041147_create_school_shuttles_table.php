<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolShuttlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_shuttles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('shuttle_name', 255)->nullable()->default('');
            $table->text('identity_card')->nullable()->default('');
            $table->text('description')->nullable()->default('');
            $table->integer('price')->unsigned()->nullable()->default(0);
            $table->text('picture')->nullable()->default('');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->unsignedBigInteger('subdistrict_id')->nullable();
            $table->foreign('subdistrict_id')->references('id')->on('subdistricts');
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
        Schema::table('school_shuttles', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->dropForeign(['subdistrict_id']);
            $table->dropColumn('subdistrict_id');
        });
        Schema::dropIfExists('school_shuttles');
    }
}

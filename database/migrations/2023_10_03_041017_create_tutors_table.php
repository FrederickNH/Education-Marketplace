<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('institution')->nullable();
            $table->string('institution_name', 255)->nullable()->default('');
            $table->text('address')->nullable();
            $table->unsignedBigInteger('city_id')->nulllable();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->unsignedBigInteger('subdistrict_id')->nullable();
            $table->foreign('subdistrict_id')->references('id')->on('subdistricts');
            $table->text('description')->nullable()->default('');
            $table->integer('price')->unsigned()->nullable()->default(0);
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
        Schema::table('tutors', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('tutors');
    }
}

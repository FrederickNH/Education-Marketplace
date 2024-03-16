<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tutor_id');
            $table->foreign('tutor_id')->references('id')->on('tutors');
            $table->unsignedBigInteger('seeking_tutor_id');
            $table->foreign('seeking_tutor_id')->references('id')->on('seeking_tutors');
            $table->integer('price')->unsigned()->nullable();
            $table->enum('status', ['Accepted', 'Waiting' ,'Rejected'])->nullable();
            $table->date('deal_date')->nullable();
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
        Schema::table('offers', function (Blueprint $table) {
            $table->dropForeign(['tutor_id']);
            $table->dropColumn('tutor_id');
            $table->dropForeign(['seeking_tutor_id']);
            $table->dropColumn('seeking_tutor_id');
        });
        Schema::dropIfExists('offers');
    }
}

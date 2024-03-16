<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitionVariansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competition_varians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("competition_id");
            $table->foreign('competition_id')->references('id')->on('competitions')->onDelete('cascade');
            $table->string('name', 255)->nullable()->default('text');
            $table->integer('price')->unsigned()->nullable();
            $table->integer('min_age')->unsigned()->nullable();
            $table->integer('max_age')->unsigned()->nullable();
            $table->integer('slot')->unsigned()->nullable();
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
        Schema::table('competition_varians', function (Blueprint $table) {
            $table->dropForeign(['competition_id']);
            $table->dropColumn('competition_id');
        });
        Schema::dropIfExists('competition_varians');
    }
}

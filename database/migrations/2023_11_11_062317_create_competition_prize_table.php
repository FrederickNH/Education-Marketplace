<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitionPrizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competition_prizes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('varian_id')->nullable();
            $table->foreign('varian_id')->references('id')->on('competition_varians');
            $table->integer('rank_no')->unsigned()->nullable();
            $table->integer('money_prize')->unsigned()->nullable();
            $table->text('other_prize')->nullable()->default('');
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
        Schema::table('competition_prizes', function (Blueprint $table) {
            $table->dropForeign(['varian_id']);
            $table->dropColumn('varian_id');
        });
        Schema::dropIfExists('competition_prizes');
    }
}

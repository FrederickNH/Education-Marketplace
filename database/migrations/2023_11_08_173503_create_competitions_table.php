<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("organiser_id");
            $table->foreign('organiser_id')->references('id')->on('competition_organisers');
            $table->string('title', 255)->nullable()->default('');
            $table->text('description')->nullable()->default('');
            $table->text('brochure')->nullable()->default('');
            $table->integer('allowed_team_member')->unsigned()->nullable()->default();
            $table->date('campaign_start')->nullable();
            $table->date('campaign_end')->nullable();
            $table->date('competition_start')->nullable();
            $table->date('competition_end')->nullable();
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
        Schema::table('competitions', function (Blueprint $table) {
            $table->dropForeign(['organiser_id']);
            $table->dropColumn('organiser_id');
            $table->dropForeign(['elegibility_id']);
            $table->dropColumn('elegibility_id');
        });
        Schema::dropIfExists('competitions');
    }
}

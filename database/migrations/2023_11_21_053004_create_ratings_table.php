<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->tinyInteger('rate')->nullable();
            $table->text('comments')->nullable()->default('');
            $table->date('date_rated')->nullable();
            $table->enum('for', ['tutor', 'school','organiser','tutoring','shuttle','competition'])->nullable();
            $table->unsignedBigInteger('given_to')->nullable();
            $table->foreign('given_to')->references('id')->on('users');
            $table->unsignedBigInteger('tutoring_id')->nullable();
            $table->foreign('tutoring_id')->references('id')->on('tutorings');
            $table->unsignedBigInteger('competition_id')->nullable();
            $table->foreign('competition_id')->references('id')->on('competitions');
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
        Schema::table('ratings', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->dropForeign(['given_to']);
            $table->dropColumn('given_to');
            $table->dropForeign(['tutoring_id']);
            $table->dropColumn('tutoring_id');
            $table->dropForeign(['competition_id']);
            $table->dropColumn('competition_id');
        });
        Schema::dropIfExists('ratings');
    }
}

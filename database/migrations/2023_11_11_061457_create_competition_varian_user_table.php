<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitionVarianUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competition_varian_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("competition_varian_id");
            $table->foreign('competition_varian_id')->references('id')->on('competition_varians');
            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('team_name', 255)->nullable()->default('');
            $table->text('participant_name')->nullable()->default('');
            $table->text('participant_phone')->nullable()->default('');
            $table->text('student_card')->nullable()->default('');
            $table->string('school_origin', 255)->nullable()->default('');
            $table->timestamp('registration_date')->nullable();
            $table->date('payment_date')->nullable();
            $table->enum('status', ['Paid', 'WaitingPayment','Canceled'])->nullable();
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
        Schema::table('competition_varian_user', function (Blueprint $table) {
            $table->dropForeign(['competition_varian_id']);
            $table->dropColumn('competition_varian_id');
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('competition_varian_user');
    }
}

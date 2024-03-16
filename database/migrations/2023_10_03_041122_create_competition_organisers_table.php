<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitionOrganisersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competition_organisers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('org_name', 50)->nullable()->default('');
            $table->string('org_email', 255)->uniqe()->nullable()->default('');
            $table->string('org_phone', 15)->nullable()->default('');
            $table->text('org_location')->nullable()->default('');
            $table->string('pic_name', 255)->nullable()->default('');
            $table->text('identity_card')->nullable()->default('');
            $table->enum('status', ['Accepted','Waiting', 'Rejected'])->nullable();
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
        Schema::table('competition_organisers', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('competition_organisers');
    }
}

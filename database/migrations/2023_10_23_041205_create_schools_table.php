<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('school_name', 100)->nullable()->default('');
            $table->unsignedBigInteger("city_id");
            $table->foreign('city_id')->references('id')->on('cities');
            $table->unsignedBigInteger("subdistrict_id");
            $table->foreign('subdistrict_id')->references('id')->on('subdistricts');
            $table->string('address', 255)->nullable()->default('');
            $table->string('phone', 15)->nullable()->default('');
            $table->text('website')->nullable()->default('');
            $table->text('vision')->nullable()->default('');
            $table->text('mission')->nullable()->default('');
            $table->enum('level', ['SMA', 'SMP','SD'])->nullable();
            $table->string('accreditation', 45)->nullable()->default('');
            $table->text('accreditation_proof')->nullable()->default('');
            $table->text('history')->nullable()->default('');
            $table->text('award')->nullable()->default('');
            $table->text('picture')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('admins');
            $table->enum('status', ['Accepted','Waiting','Rejected'])->nullable();
            $table->date('enrollment_start')->nullable();
            $table->date('enrollment_end')->nullable();
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
        Schema::table('schools', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->dropForeign(['subdistrict_id']);
            $table->dropColumn('subdistrict_id');
            $table->dropForeign(['admin_id']);
            $table->dropColumn('admin_id');
        });
        Schema::dropIfExists('schools');
    }
}

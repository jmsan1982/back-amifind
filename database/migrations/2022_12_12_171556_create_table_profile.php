<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('avatar')->nullable();
            $table->text('description')->nullable();
            $table->integer('location_id')->nullable();
            $table->decimal('latitude',10,8)->nullable();
            $table->decimal('longitude', 11,8)->nullable();
            $table->dateTime('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('searching');
            $table->integer('search_age_from');
            $table->integer('search_age_to');
            $table->integer('search_distance')->nullable();
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
        Schema::dropIfExists('table_profile');
    }
}

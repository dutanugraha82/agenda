<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('act_name');
            $table->dateTime('act_date');
            $table->text('act_address');
            $table->integer('partisipant');
            $table->string('image');
            $table->enum('type',['public','private']);
            $table->enum('category',['internal','umum']);
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->enum('act_status',['reject','pending','publish'])->default('pending');
            $table->dateTime('status_at')->nullable();
            $table->text('feedback')->nullable();
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
        Schema::dropIfExists('acivities');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_media', function (Blueprint $table) {
            $table->id();
            $table->string('socmed_name');
            $table->dateTime('socmed_date');
            $table->text('socmed_address');
            $table->text('caption');
            $table->string('thumbnail');
            $table->enum('category',['nasional','internasional']);
            $table->text('socmed_url');
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->enum('socmed_status',['reject','pending','publish'])->default('pending');
            $table->text('feedback')->nullable();
            $table->dateTime('status_at')->nullable();
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
        Schema::dropIfExists('social_media');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('websites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unit_website_id');
            $table->foreign('unit_website_id')->references('id')->on('unit_website');
            $table->string('web_name');
            $table->dateTime('web_date');
            $table->text('web_address');
            $table->string('web_thumbnail');
            $table->string('web_document');
            $table->enum('web_category',['nasional','internasional']);
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->enum('web_status',['reject','pending','publish'])->default('pending');
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
        Schema::dropIfExists('websites');
    }
}
